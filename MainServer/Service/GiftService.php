<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Exception\BusinessException;
use ImiApp\MainServer\Model\Cp;
use ImiApp\MainServer\Model\Dressup;
use ImiApp\MainServer\Model\Gift;
use ImiApp\MainServer\Model\GiveCpgiftLog;
use ImiApp\MainServer\Model\GiveGiftLog;
use ImiApp\MainServer\Model\Headframe;
use ImiApp\MainServer\Model\Intimacy;
use ImiApp\MainServer\Model\Jiyou;
use ImiApp\MainServer\Model\Knapsack;
use Imi\Db\Annotation\Transaction;
use ImiApp\MainServer\Model\Roomsendgiftlog;
use ImiApp\MainServer\Model\User;
use Imi\Aop\Annotation\Inject;

/**
 * Class GiftService
 * @package ImiApp\MainServer\Service
 * @Bean("GiftService")
 */
class GiftService
{
    /**
     * @var
     * @Inject("UserService")
     */
    protected $UserService;
    /**
     * Date: 2021/6/17
     * Time: 15:43
     * @param int $page
     * @param int $page_size
     * @return array
     * 礼物列表
     */
    public function getGift(int $page, int $page_size)
    {
        $info = Gift::query()->page($page, $page_size)->select()->getArray();
        $count = Gift::count();

        return [
            'list' => $info,
            'count' => $count,
        ];
    }

    /**
     * Date: 2021/6/17
     * Time: 15:44
     * @param string $url
     * @param int $price
     * @param int $type
     * 设置礼物
     */
    public function setGift(string $url, int $price, int $type,string $name,string $cover)
    {
        $info = Gift::newInstance();
        $info->setAddTime(time());
        $info->setUrl($url);
        $info->setPrice($price);
        $info->setType($type);
        $info->setName($name);
        $info->setCover($cover);
        $info->insert();
    }

    /**
     * Date: 2021/6/17
     * Time: 15:44
     * 删除礼物
     * @param int $id
     */
    public function deleteGift(string $id)
    {
        $idlist = explode(',', $id);
        Gift::query()->whereIn('id', $idlist)->delete();
    }

    /**
     * Date: 2021/6/21
     * Time: 14:54
     * @param string $url
     * @param int $price
     * 设置头像框
     */
    public function setHeadFrame(string $url, int $price)
    {
        Headframe::newInstance()->setAddTime(time())->setPrice($price)->setUrl($url);
    }

    /**
     * Date: 2021/6/17
     * Time: 16:08
     * @param int $shop_id
     * @param int $uid
     * @throws BusinessException
     * @Transaction
     * 购买装扮
     */
    public function PurchaseGift(int $shop_id, int $uid)
    {
        $info = Knapsack::find([
            'shop_id' => $shop_id,
            'uid' => $uid,
        ]);
        if ($info) {
            throw new BusinessException('您已拥有该装扮');
        } else {
            $Gift = Gift::find($shop_id);
            //添加一条记录
            Knapsack::newInstance()
                ->setShopId($shop_id)
                ->setUid($uid)
                ->setType($Gift->getType())
                ->setPrice($Gift->getPrice())
                ->setAddTime(time())
                ->insert();
            //减去账户余额
            User::query()->where('user_id', '=', $uid)
                ->setFieldDec('balance', $Gift->getPrice())->update();
        }
    }

    /**
     * Date: 2021/6/21
     * Time: 16:25
     * @param int $shop_id
     * @param int $accept_id
     * @param int $uid
     * @Transaction
     * 曾送礼物增加亲密度
     * 赠送礼物的前置判断
     */
    public function GiveIntimacyGift(int $shop_id,int $accept_id,int $uid)
    {

        $Gift=Gift::find($shop_id);
        $price=$Gift->getPrice();
        //查找作为主动送礼物的存不存在
        $find=Intimacy::find([
            'give_id' => $uid,
            'accept_id' => $accept_id
        ]);
        //查找作为接受礼物的人存不存在
        $info=Intimacy::find([
            'give_id' => $accept_id,
            'accept_id' => $uid
        ]);
        if($Gift->getType()==3){
            if($find->getCountvalue()=='1000' or $info->getCountvalue()=='1000'){
                $isCp1=Cp::find([
                    'give_id' => $uid,
                    'isAgree' =>1
                ]);
                $isCp2=Cp::find([
                    'accept_id' => $accept_id,
                    'isAgree' =>1
                ]);
                if($isCp1){
                    throw new BusinessException('您已经绑定cp');
                }
                if($isCp2){
                    throw new BusinessException('您邀请的人的已经绑定cp');
                }
                $cp1=Cp::find([
                    'give_id' => $uid,
                    'accept_id' => $accept_id
                ]);
                $cp2=Cp::find([
                    'give_id' => $accept_id,
                    'accept_id' => $uid
                ]);
                //cp1 ==1 或 cp2 == 1 证明两个人是cp可以送礼物
                if($cp1->getIsAgree()==1 or $cp2->getIsAgree()==1){
                    $this->SendGift($shop_id,$accept_id,$uid,$find,$info,$price,$Gift);
                    //增加cp值
                    $this->IncreaseCpValue($cp1,$cp2,$uid,$accept_id,$price);
                }
                //cp1 == ‘’ and cp2 ==‘’ 证明两人都没有cp 赠送礼物就成了发送一条邀请
                if(empty($cp1) && empty($cp2)){
                    //增加告白值
                    $this->SendCpGift($shop_id,$accept_id,$uid,$price,$Gift);
                }
            }else{
                throw new BusinessException('告白值不够,请先赠送告白礼物增加告白礼物');
            }
        }
        if($Gift->getType()==6){
            $Jiyou1=Jiyou::find([
                'give_id' => $uid,
                'accept_id' => $accept_id
            ]);
            $Jiyou2=Jiyou::find([
                'give_id' => $accept_id,
                'accept_id' => $uid
            ]);
            //cp1 ==1 或 cp2 == 1 证明两个人是cp可以送礼物
            if(!empty($Jiyou1)==1 or !empty($Jiyou2)){
                $this->SendGift($shop_id,$accept_id,$uid,$find,$info,$price,$Gift);
                //增加cp值
                $this->IncreaseJyValue($Jiyou1,$Jiyou2,$uid,$accept_id,$price);
            }
            //俩人都不存在加入
            if(empty($Jiyou1) && empty($Jiyou2)){
                $this->SendJyGift($shop_id,$accept_id,$uid,$price,$Gift);
            }
        }
        $this->SendGift($shop_id,$accept_id,$uid,$find,$info,$price,$Gift);
        //信息存在说明首先像是对方赠送礼物,直接增加礼物值

    }

    /**
     * Date: 2021/6/22
     * Time: 16:28
     * @param $shop_id
     * @param $accept_id
     * @param $uid
     * @param $find
     * @param $info
     * @param $price
     * @param $Gift
     * 赠送礼物，增加告白值
     */
    protected function SendGift($shop_id,$accept_id,$uid,$find,$info,$price,$Gift)
    {
        if($find){
            $find->setCountvalue($find->getCountvalue()+$price);
            $find->update();
        }else{
            //作为主栋送礼物的如存在在判断被动接受礼物的存不存在
            if($info){
                $info->setCountvalue($info->getCountvalue()+$price);
                $info->update();
            }else{
                //如果既不是主动赠送礼物又不是接受礼物的，直接认为主动赠送礼物存入
                Intimacy::newInstance()
                    ->setGiveId($uid)
                    ->setAcceptId($accept_id)
                    ->setCountvalue($price)
                    ->insert();
            }
        }
        //加入送礼物记录
        GiveGiftLog::newInstance()
            ->setUid($uid)
            ->setShopId($shop_id)
            ->setAcceptId($accept_id)
            ->setAddTime(time())
            ->setPrice($price)
            ->insert();
        $this->ReduceUserBalance($uid,$accept_id,$Gift);
    }

    /**
     * Date: 2021/6/22
     * Time: 16:28
     * @param $shop_id
     * @param $accept_id
     * @param $uid
     * @param $price
     * @param $Gift
     * 赠送cp礼物实际操作
     */
    protected function SendCpGift($shop_id,$accept_id,$uid,$price,$Gift)
    {
        Cp::newInstance()
            ->setGiveId($uid)
            ->setShopId($shop_id)
            ->setAcceptId($accept_id)
            ->setCountvalue($price)
            ->setAddTime(time())
            ->insert();
        $this->ReduceUserBalance($uid,$accept_id,$Gift);
    }

    /**
     * Date: 2021/6/23
     * Time: 14:31
     * @param $cp1
     * @param $cp2
     * @param $price
     * 增加cp值
     */
    protected function IncreaseCpValue($cp1,$cp2,$price)
    {
        if(!empty($cp1)){
            $cp1->setCountvalue($cp1->getCountvalue() + $price)->update;
        }
        if(!empty($cp2))
        {
            $cp1->setCountvalue($cp1->getCountvalue() + $price)->update;
        }
    }

    /**
     * Date: 2021/6/23
     * Time: 15:29
     * 成为基友
     */
    protected function SendJyGift($shop_id,$accept_id,$uid,$price,$Gift)
    {
        Jiyou::newInstance()
            ->setGiveId($uid)
            ->setShopId($shop_id)
            ->setAcceptId($accept_id)
            ->setCountvalue($price)
            ->setAddTime(time())
            ->insert();
        $this->ReduceUserBalance($uid,$accept_id,$Gift);
    }
    /**
     * Date: 2021/6/23
     * Time: 14:31
     * @param $cp1
     * @param $cp2
     * @param $price
     * 增加基友值
     */
    protected function IncreaseJyValue($Jiyou1,$Jiyou2,$price)
    {
        if(!empty($Jiyou1)){
            $Jiyou1->setCountvalue($Jiyou1->getCountvalue() + $price)->update;
        }
        if(!empty($Jiyou2))
        {
            $Jiyou2->setCountvalue($Jiyou2->getCountvalue() + $price)->update;
        }
    }
    /**
     * Date: 2021/6/22
     * Time: 16:09
     * 减少用户余额正增加财富
     */
    protected  function ReduceUserBalance($uid,$accept_id,$Gift)
    {

        //增加送礼人的财富值
        $this->UserService->getUserInfo($uid)
            ->setBalance(
                $this->UserService->getUserInfo($uid)->getBalance() - $Gift->getPrice()
            )->setWealthvalue($this->UserService->getUserInfo($uid)->getBalance() + $Gift->getPrice())->update();
        //增加接受礼物的魅力值
        $this->UserService->getUserInfo($accept_id)->setCharmvalue(
            $this->UserService->getUserInfo($uid)->getCharmvalue() + $Gift->getPrice()
        )->update();
    }

    /***
     * Date: 2021/7/1
     * Time: 11:09
     * @param string $roomnumber
     * @param int $shop_id
     * @param int $accept_id
     * @param int $uid
     */
    public function RoomSendGift(string $roomnumber,int $shop_id,int $accept_id,int $uid)
    {
        $Gift=Gift::find($shop_id);
        Roomsendgiftlog::newInstance()
            ->setRoomnumber($roomnumber)
            ->setUid($uid)
            ->setAcceptId($accept_id)
            ->setShop($shop_id)
            ->setPrice($Gift->getPrice())
            ->setAddTime(time())
            ->insert();
        $this->ReduceUserBalance($uid,$accept_id,$Gift);
    }
//    public function GiveCpGift(int $shop_id,int $accept_id,int $uid)
//    {
//        $cp1=Intimacy::find([
//            'give_id' => $uid,
//            'accept_id' => $accept_id
//        ]);
//        $cp2=Intimacy::find([
//            'give_id' => $accept_id,
//            'accept_id' => $uid
//        ]);
//        if(!$cp1 && !$cp2){
//
//        }
//        //加入送礼物记录
//        $price=Gift::find($shop_id)->getPrice();
//        GiveGiftLog::newInstance()
//            ->setUid($uid)
//            ->setShopId($shop_id)
//            ->setAcceptId($accept_id)
//            ->setAddTime(time())
//            ->setPrice($price);
//    }
}
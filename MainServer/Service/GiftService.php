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
use ImiApp\MainServer\Model\Knapsack;
use Imi\Db\Annotation\Transaction;
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
    public function setGift(string $url, int $price, int $type)
    {
        $info = Gift::newInstance();
        $info->setAddTime(time());
        $info->setUrl($url);
        $info->setPrice($price);
        $info->setType($type);
        $info->insert();
    }

    /**
     * Date: 2021/6/17
     * Time: 15:44
     * 删除礼物
     * @param int $id
     */
    public function deleteGift(int $id)
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
                $cp1=Cp::find([
                    'give_id' => $uid,
                    'accept_id' => $accept_id
                ]);
                $cp2=Cp::find([
                    'give_id' => $accept_id,
                    'accept_id' => $uid
                ]);
                if($cp1->getIsAgree()==1){
                    throw new BusinessException('您已经绑定cp');
                }
                if($cp2->getIsAgree()==1){
                    throw new BusinessException('您要赠送的人已经绑定cp');
                }
                $this->SendCpGift($shop_id,$accept_id,$uid,$price,$Gift);
            }else{
                throw new BusinessException('告白值不够,请先赠送告白礼物增加告白礼物');
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
     * 赠送告白值
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
            ->setPrice($price);
        $this->ReduceUserBalance($uid,$Gift);
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
        $this->ReduceUserBalance($uid,$Gift);
    }
    /**
     * Date: 2021/6/22
     * Time: 16:09
     * 减少用户财富值
     */
    protected  function ReduceUserBalance($uid,$Gift)
    {

        $this->UserService->getUserInfo($uid)
            ->setBalance(
                $this->UserService->getUserInfo($uid)->getBalance() - $Gift->getPrice()
            )->update();
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
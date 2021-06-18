<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Exception\BusinessException;
use ImiApp\MainServer\Model\Dressup;
use ImiApp\MainServer\Model\Gift;
use ImiApp\MainServer\Model\Knapsack;
use Imi\Db\Annotation\Transaction;
use ImiApp\MainServer\Model\User;

/**
 * Class GiftService
 * @package ImiApp\MainServer\Service
 * @Bean("GiftService")
 */
class GiftService
{
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
     * Date: 2021/6/17
     * Time: 16:08
     * @param int $shop_id
     * @param int $uid
     * @throws BusinessException
     * @Transaction
     * 购买礼物
     */
    public function PurchaseGift(int $shop_id,int $uid)
    {
        $info=Knapsack::find([
            'shop_id' => $shop_id,
            'uid' => $uid
        ]);
        if($info){
            throw new BusinessException('您已拥有该装扮');
        }else{
            $Dressup= Dressup::find($shop_id);
            //添加一条记录
            Knapsack::newInstance()
                ->setShopId($shop_id)
                ->setUid($uid)
                ->setType($Dressup->getType())
                ->setPrice($Dressup->getPrice())
                ->setAddTime(time())
                ->insert();
            //减去账户余额
            User::query()->where('user_id','=',$uid)
                ->setFieldDec('balance',$Dressup->getPrice())->update();
        }
    }
}
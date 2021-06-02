<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Model\Gift;

/**
 * Class GiftService
 * @package ImiApp\MainServer\Service
 * @Bean("GiftService")
 */
class GiftService
{
    public function getGift(int $page,int $page_size)
    {
        $info=Gift::query()->page(($page-1)*$page_size,$page_size)->select()->getArray();
        $count=Gift::count();
        return [
            'list' => $info,
            'count' => $count
        ];
    }

    public function setGift(string $url,int $price,int $type)
    {
        $info=Gift::newInstance();
        $info->setAddTime(time());
        $info->setUrl($url);
        $info->setPrice($price);
        $info->setType($type);
        $info->insert();
    }
}
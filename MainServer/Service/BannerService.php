<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Model\Banner;
/**
 * @Bean("BannerService")
 */
class BannerService
{
    public function getBanner(string $position)
    {
        $info=Banner::find(['position'=>$position]);
        return $info;
    }
}
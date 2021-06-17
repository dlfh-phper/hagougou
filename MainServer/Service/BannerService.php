<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use Imi\Db\Db;
use ImiApp\MainServer\Model\Banner;

/**
 * @Bean("BannerService")
 */
class BannerService
{
    /**
     * Date: 2021/5/31
     * Time: 14:38
     * @param string $position
     * @return Banner|null
     * 通过位置查询轮播图
     */
    public function getBanner(string $position)
    {
        $info = Banner::query()->where('position','=',$position)->order('id','desc')->select();
        $res=$info->get();
        return $res;
    }

    /**
     * Date: 2021/5/31
     * Time: 14:38
     * @param string $content
     * @param string $position
     * 添加轮播图
     */
    public function setBanner(string $content, string $position)
    {
        $info = Banner::newInstance();
        $info->setAddTime(time());
        $info->setContent($content);
        $info->setPosition($position);
        $info->insert();
    }

    /**
     * Date: 2021/5/31
     * Time: 14:45
     * @param int $id
     * 删除
     */
    public function deleteBanner(string $id)
    {
        $idlist = explode(',', $id);
        Banner::query()->whereIn('id', $idlist)->delete();
//        Banner::deleteBatch(['id'=>$id]);
    }

    /**
     * Date: 2021/5/31
     * Time: 14:47
     * 列表一共就三个，不用做列表
     */
    public function getBannerList()
    {
        $info = Banner::dbQuery()->order('id', 'desc')->select()->getArray();
        return $info;
    }
}
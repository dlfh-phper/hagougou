<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Model\Officialmsg;

/**
 * Class OfficialmsgService
 * @package ImiApp\MainServer\Service
 * @Bean("OfficialmsgService")
 */
class OfficialmsgService
{
    /**
     * Date: 2021/6/3
     * Time: 16:33
     * @param string $title
     * @param string $content
     * @param string $img
     * @param string $previewcontent
     * @param int $id
     * 添加修改消息
     */
    public function setMsg(string $title,string $content,string $img,string $previewcontent,int $id)
    {
        $info=Officialmsg::newInstance();
        $info->title=$title;
        $info->content=$content;
        $info->img=$img;
        $info->previewcontent=$previewcontent;
        if($id){
            $info->id=$id;
        }
        $info->add_time=time();
        $info->save();
    }
}
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

    /**
     * Date: 2021/6/4
     * Time: 10:03
     * @param int $page
     * @param int $page_size
     * @return array
     * 消息列表
     */
    public function  getMsgList(int $page,int $page_size)
    {
        $list=Officialmsg::query()->page(($page-1)*$page_size,$page_size)->order('id','desc')->select()->getArray();
        $count=Officialmsg::count();
        return [
            'list' => $list,
            'count' => $count
        ];
    }

    /**.
     * Date: 2021/6/4
     * Time: 10:12
     * @param int $id
     * @return Officialmsg|null
     * 详情
     */
    public function getMsgInfo(int $id)
    {
        return Officialmsg::find($id);
    }
}
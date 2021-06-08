<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Model\Topic;

/**
 * Class TopicService
 * @package ImiApp\MainServer\Service
 * @Bean("TopicService")
 */
class TopicService
{
    /**
     * Date: 2021/6/7
     * Time: 15:21
     * @param string $label
     * @param string $url
     * @param int $id
     * 设置热议话题，有id修改，id为空添加
     */
    public function setTopic(string $label,string $url,int $id)
    {
        $info = Topic::newInstance();
        $info->label=$label;
        $info->url=$url;
        $info->add_time=time();
        $info->id=$id;
        $info->save();
    }

    /**
     * Date: 2021/6/7
     * Time: 15:24
     * @param int $page
     * @param int $page_size
     */
    public function getTopiclist(int $page,int $page_size)
    {
        $list=Topic::query()->page(($page-1)*$page_size,$page_size)->order('id','desc')->select()->getArray();
        $count=Topic::count();
        return [
            'list'=>$list,
            'count'=>$count
        ];
    }

    /**
     * Date: 2021/6/7
     * Time: 15:26
     * @param string $id
     */
    public function deleteTopic(string $id)
    {
        $idlist=explode(',',$id);
        Topic::query()->whereIn('id',$idlist)->delete();
    }
}
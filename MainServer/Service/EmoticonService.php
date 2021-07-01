<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Model\Emoticon;

/**
 * Class AdminUserService
 * @package ImiApp\MainServer\Service
 * @Bean("EmoticonService")
 */
class EmoticonService
{
    /**
     * Date: 2021/7/1
     * Time: 16:10
     * @param int $page
     * @param int $page_size
     * @return array
     * 列表
     */
    public function getEmoticonList(int $page,int $page_size)
    {
        return [
            'list' => Emoticon::query()->page($page,$page_size)->order('id','desc')->select()->getArray(),
            'count' => Emoticon::count()
        ];
    }

    /**
     * Date: 2021/7/1
     * Time: 16:12
     * @param string $url
     * @param string $name
     * 设置表情
     */
    public function setEmoticon(string $url,string $name)
    {
        Emoticon::newInstance()
            ->setUrl($url)
            ->setName($name)
            ->setAddTime(time())
            ->insert();
    }

    /**
     * Date: 2021/7/1
     * Time: 16:13
     * @param string $id
     * 删除表情
     */
    public function EmoticonDeleTe(string $id)
    {
        Emoticon::query()->whereIn('id',explode(',',$id))->delete();
    }

    /**
     * Date: 2021/7/1
     * Time: 16:14
     * @param int $id
     * 单条
     */
    public function getFind(int $id)
    {
        return Emoticon::find($id);
    }
}
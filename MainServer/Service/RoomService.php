<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Exception\BusinessException;
use ImiApp\MainServer\Model\Room;
use ImiApp\MainServer\Model\Rootlabel;

/**
 * @Bean("RoomService")
 */
class RoomService
{
    /**
     * Date: 2021/5/19
     * Time: 11:38
     * @return array
     * 首页房间
     */
       public function indexRoom()
       {
           $info=Room::query()->order('giftvalue','desc')->limit(6)->select()->getArray();
           return $info;
       }

    /**
     * Date: 2021/5/19
     * Time: 11:38
     * @param string $label
     * @return bool
     * @throws BusinessException
     * 房间标签设置
     */
       public function getRoomlabel(string $label)
       {
           try {
               $info=Rootlabel::newInstance();
               $info->setLabel($label);
               $info->setAddTime(time());
               $info->update();
               return true;
           }catch (BusinessException $businessException){
               throw new BusinessException($businessException->getMessage());
           }
       }

    /**
     * Date: 2021/5/19
     * Time: 11:58
     * @param string $page
     * @param string $page_size
     * @return array
     *按照房间热度排列
     */
       public function roomRanking(string $page,string $page_size)
       {
            $list=Room::query()->order('giftvalue','desc')->page(($page-1)*$page_size,$page_size)->select()->getArray();
            $count=Room::count('id');
            return [
                'list'=>$list,
                'count'=>$count
            ];
       }

    /**
     * Date: 2021/5/19
     * Time: 14:06
     * @param string $label
     * @return array
     * 通过标签搜索房间
     */
       public function roomLabelSearch(string $label)
       {
           $list=Room::query()->whereRaw("label->'$.label'='{$label}'")->select()->getArray();
           $count=Room::query()->whereRaw("label->'$.label'='{$label}'")->count('id');
           return [
               'list'=>$list,
               'count'=>$count
           ];
       }

       public function getCollectionRoom(string $page,string $page_size,int $uid)
       {
           
       }
}
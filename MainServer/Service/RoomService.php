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
}
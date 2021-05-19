<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Model\Room;

/**
 * @Bean("RoomService")
 */
class RoomService
{
       public function indexRoom()
       {
           $info=Room::query()->order('giftvalue','desc')->limit(6)->select()->getArray();
           return $info;
       }
}
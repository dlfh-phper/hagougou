<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Exception\BusinessException;
use ImiApp\MainServer\Model\Room;
use ImiApp\MainServer\Model\Rootlabel;

/**
 * Class RoomService
 * @package ImiApp\MainServer\Service
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
           $list=Room::query()->whereRaw("JSON_CONTAINS(label,JSON_OBJECT('label', '{$label}'))")->select()->getArray();
           $count=Room::query()->whereRaw("JSON_CONTAINS(label,JSON_OBJECT('label', '{$label}'))")->count('id');
           return [
               'list'=>$list,
               'count'=>$count
           ];
       }

    /**
     * Date: 2021/5/20
     * Time: 14:24
     * @param int $roomnumber
     * @param string $title
     * @param string $cover
     * @param string $label
     * @param string $introduce
     * @param string $eception
     * @param string $welcome
     * @param string $blacklist
     * @param string $password
     * @param int $isPush
     * @param int $uid
     * @return bool
     * @throws BusinessException
     * 设置直播间，直播间存在就修改信息，不存在就添加，如果操作数据库失败，就抛出异常
     */
       public function setRoom(
           int $roomnumber,
           string $title,
           string $cover,
           string $label,
           string $introduce,
           string $eception,
           string $welcome,
           string $blacklist,
           string $password,
           int $isPush=0,
           int $uid
       )
       {
           try {
               $room=Room::find(['roomnumber'=>$roomnumber]);
               $room->setRoomnumber($roomnumber);
               $room->setTitle($title);
               $room->setLabel($label);
               $room->setCover($cover);
               $room->setIntroduce($introduce);
               $room->setEception($eception);
               $room->setWelcome($welcome);
               $room->setBlacklist($blacklist);
               $room->setPassword($password);
               $room->setIsPush($isPush);
               $room->setUserId($uid);
               $room->setIsStop('1');
               $room->setStartTime(time());
               if($room){
                   $room->update();
               }else{
                   $room->setGiftvalue('0');
                   $room->setCountvalue('0');
                   $room->insert();

               }
               return true;
           }catch (BusinessException $businessException){
               throw new BusinessException($businessException->getMessage());
           }

       }

    /**3
     * Date: 2021/5/20
     * Time: 14:34
     * @param int $uid
     * @param int $roomnumber
     * 设置房间黑名单
     */
       public function setRoomBlacklist(int $uid,int $roomnumber)
       {
           $room=Room::find(['roomnumber'=>$roomnumber]);
           $room->setBlacklist($uid);
       }

    /**
     * Date: 2021/5/20
     * Time: 14:38
     * @param int $uid
     * @return Room|null
     * 获取房间信息
     */
       public function getRoomInfo(int $uid)
       {
           $room=Room::find(['uiser_id'=>$uid]);
           return $room;
       }

    /**
     * Date: 2021/5/20
     * Time: 14:38
     * @param int $uid
     * @return string
     * 获取房间黑名单信息
     */
       public function getRoomBlacklistInfo(int $uid)
       {
           $room=Room::find(['uiser_id'=>$uid]);
           return $room->getBlacklist();
       }
}
<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use Imi\Redis\RedisManager;
use ImiApp\MainServer\Exception\BusinessException;
use ImiApp\MainServer\Exception\NotFoundException;
use ImiApp\MainServer\Model\Contrastroompasswordlog;
use ImiApp\MainServer\Model\Gift;
use ImiApp\MainServer\Model\Headframe;
use ImiApp\MainServer\Model\Room;
use ImiApp\MainServer\Model\Roomblack;
use ImiApp\MainServer\Model\Rootlabel;
use Imi\Aop\Annotation\Inject;

/**
 * Class RoomService
 * @package ImiApp\MainServer\Service
 * @Bean("RoomService")
 */
class RoomService
{
    /**
     * @var
     * @Inject("UserService");
     */
    protected $UserService;
    /**
     * Date: 2021/5/19
     * Time: 11:38
     * @return array
     * 首页房间
     */
    public function indexRoom()
    {
        $info = Room::dbQuery()->order('giftvalue', 'desc')->limit(6)->select()->getArray();
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
            $info = Rootlabel::newInstance();
            $info->setLabel($label);
            $info->setAddTime(time());
            $info->update();

            return true;
        } catch (BusinessException $businessException) {
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
    public function roomRanking(string $page, string $page_size)
    {
        $list = Room::query()->order('giftvalue', 'desc')->page($page, $page_size)->select()->getArray();
        $count = Room::count('id');

        return [
            'list' => $list,
            'count' => $count,
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
        $list = Room::query()->whereRaw("JSON_CONTAINS(label,JSON_OBJECT('label', '{$label}'))")->select()->getArray();
        $count = Room::query()->whereRaw("JSON_CONTAINS(label,JSON_OBJECT('label', '{$label}'))")->count('id');

        return [
            'list' => $list,
            'count' => $count,
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
        string $eception,
        string $welcome = null,
        int $uid,
        string $label = '',
        string $introduce = '',
        string $password = null,
        int $isPush = 0

    ) {
        try {
            $info = Room::find(['roomnumber' => $roomnumber]);
            if($info){
                $room=$info;
            }else{
                $room=Room::newInstance();
            }
            $room->setRoomnumber($roomnumber);
            $room->setTitle($title);
            $room->setLabel($label);
            $room->setCover($cover);
            $room->setIntroduce($introduce);
            $room->setEception($eception);
            $room->setWelcome($welcome);
            $room->setPassword($password);
            $room->setIsPush($isPush);
            $room->setUserId($uid);
            $room->setIsStop('1');
            $room->setStartTime(time());
            if ($info) {
                $room->update();
            } else {
                $room->setGiftvalue('0');
                $room->setCountvalue('0');
                $room->insert();

            }
            return true;
        } catch (BusinessException $businessException) {
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
    public function setRoomBlacklist(int $uid, int $roomnumber)
    {
        Roomblack::newInstance()
            ->setUid($uid)
            ->setRoomnumber($roomnumber)
            ->setAddTime(time())
            ->insert();
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
        $room = Room::find(['user_id' => $uid])->toArray();
        $room['blacklist'] = Roomblack::find(['roomnumber'=>$room['roomnumber']]);
        return $room;
    }

    /**
     * Date: 2021/5/20
     * Time: 14:38
     * @param int $uid
     * @return string
     * 获取房间黑名单信息
     */
    public function getRoomBlacklistInfo(int $roomnumber,int $page,int $page_size)
    {
        $list = Roomblack::dbQuery()->page($page,$page_size)->order('id','desc')->where('roomnumber','=',$roomnumber)->select()->getArray();
        foreach ($list as $key=>$value)
        {
            $list[$key]['head'] = $this->UserService->getUserInfo($value['uid'])->getHead();
            $list[$key]['nickname'] = $this->UserService->getUserInfo($value['uid'])->getNickname();
            $list[$key]['headkuang'] = $this->UserService->getUserInfo($value['uid'])->getHeadkuang();
        }
        $count = Roomblack::query()->where('roomnumber','=',$roomnumber)->select()->getRowCount();
        return  [
            'list' => $list,
            'count' => $count
        ];

    }

    /**
     * Date: 2021/6/21
     * Time: 11:08
     * @param int $roomnumber
     * @param string $bulletin
     * @param int $uid
     * @throws NotFoundException
     * 设置公告栏
     */
    public function setBulletin(int $roomnumber, string $bulletin,int $uid)
    {
        $room = Room::find([
            'roomnumber' => $roomnumber,
            'uid' => $uid
        ]);
        if($room){
            $room->setBulletin($bulletin);
            $room->update();
        }else{
            throw new NotFoundException(sprintf('房间号为 %s 直播间不存在',$roomnumber));

        }
    }

    /**
     * Date: 2021/6/21
     * Time: 14:26
     * @param int $roomnumber
     * @return Room|null
     * 获取直播间信息
     */
    public function RoomInfo(int $roomnumber)
    {
        return  Room::find(['roomnumber' => $roomnumber]);
    }

    /***
     * Date: 2021/6/23
     * Time: 10:39
     * @param int $page
     * @param int $page_size
     * @return array
     * 直播间礼物
     */
    public function getRoomGft(int $page,int $page_size)
    {
        return [
            'list' => Gift::query()->page($page,$page_size)->where('type','=','1')->order('id','desc')->select()->getArray(),
            'count' => Gift::query()->where('type','=','1')->select()->getRowCount()
        ];
    }

    /**
     * Date: 2021/6/24
     * Time: 15:22
     * @param string $Search
     * @param int $page
     * @param int $page_size
     * @return array
     * 黑名单搜索
     */
    public function SearchRoomBlack(string $Search,int $page,int $page_size,string $roomnumber)
    {
         $useinfo = $this->UserService->nickNameAndIdSearch($Search,$page,$page_size);
         $userarry= array_column($useinfo['list'],'user_id');
         $Black=Roomblack::dbQuery()->where('roomnumber','=',$roomnumber)->whereIn('uid',$userarry)->select()->getArray();
         foreach ($Black as $key => $value){
             $Black[$key]['head'] = $this->UserService->getUserInfo($value['uid'])->getHead();
             $Black[$key]['nickname'] = $this->UserService->getUserInfo($value['uid'])->getNickname();
             $Black[$key]['headkuang'] = $this->UserService->getUserInfo($value['uid'])->getHeadkuang();
         }
         return [
            'list' => $Black,
            'count' =>  Roomblack::query()->where('roomnumber','=',$roomnumber)->whereIn('uid',$userarry)->select()->getRowCount()
         ];

    }

    /**
     * Date: 2021/6/24
     * Time: 15:31
     * @param int $uid
     * @param string $roomnumber
     */
    public function RemoveBlack(int $uid,string $roomnumber)
    {
        Roomblack::find(['uid' => $uid,'roomnumber' => $roomnumber])->delete();
    }

    /**
     * Date: 2021/6/29
     * Time: 10:40
     * @param string $roomnumber
     * @param string $password
     * @param int $uid
     * @throws BusinessException
     */
    public function ContrastRoomPassword(string $roomnumber,string $password,int $uid)
    {
        $ContrastRoomPassword=Contrastroompasswordlog::find(['uid'=>$uid,'roomnumber'=>$roomnumber]);
        //验证密码成功直接return
        if($this->getRoomInfo($roomnumber)->getPassword()==$password){
            //密码验证通过以后如果有不同过的记录存在直接删除
            if($ContrastRoomPassword){
                $ContrastRoomPassword->delete();
            }
            return;
        }else{
            if($ContrastRoomPassword){
                //判断密码错误次数是否5次
                if($ContrastRoomPassword->getCount()>=5)
                {
                    throw new BusinessException('密码验证失败5次,24小时以后才能进入');
                }else{
                    //返回剩余次数
                    $ContrastRoomPassword->setCount($ContrastRoomPassword->getCount() + 1)->update();
                    throw new BusinessException(sprintf('密码验证失败您还有%s 机会',5 - $ContrastRoomPassword->getCount()));
                }
            }else{
                //首次输错密码加入记录
                $ContrastRoomPassword->setUid($uid)->setRoomnumber($roomnumber)->setAddTime(time())->insert();
                throw new BusinessException('密码验证失败还有4次机会');
            }

        }
    }
}
<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use Imi\ConnectContext;
use Imi\Server\Server;
use Imi\Aop\Annotation\Inject;
use Imi\ServerManage;

/**
 * Class RoomService
 * @package ImiApp\MainServer\Service
 * @Bean("RoomGroupService");
 */
class RoomGroupService
{
    /**
     * @var
     * @Inject("UserService");
     */
    protected $UserService;

    /**
     * Date: 2021/6/30
     * Time: 14:09
     * @param $Fds
     * @param $room
     * 直播间坑位变化推送
     */
    public function pushRoomMaiWeiinfo($Fds,$room)
    {

        $swooleServer=ServerManage::getServer('main')->getSwooleServer();
        foreach ($Fds as $key=>$value)
        {
            $userarry[$key]=$swooleServer->getClientInfo($value)['uid'];
        }
        foreach ($userarry as $k=>$v){
            $userinfo[$k]['info']=$this->UserService->getUserInfo($v)->toArray() ?? '';
        }
        Server::sendToGroup($room,$userinfo);
    }
}
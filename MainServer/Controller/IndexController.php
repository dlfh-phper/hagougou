<?php
namespace ImiApp\MainServer\Controller;

use Imi\ConnectContext;
use Imi\Controller\WebSocketController;
use Imi\Server\Route\Annotation\WebSocket\WSRoute;
use Imi\Server\Route\Annotation\WebSocket\WSAction;
use Imi\Server\Route\Annotation\WebSocket\WSController;
use Imi\Server\Route\Annotation\WebSocket\WSMiddleware;
use Imi\Server\Server;
use Imi\Aop\Annotation\Inject;
use ImiApp\Enum\MessageCode;

/**
 * 数据收发测试
 * @WSController
 */
class IndexController extends WebSocketController
{
    /**
     * @Inject("RedisService");
     * @var
     */
    protected $RedisService;
    /**
     * @var
     * @Inject("RoomGroupService");
     */
    protected $RoomGroupService;
    /**
     * 发送消息
     *
     * @WSAction
     * @WSRoute({"action"="send"})
     * @param
     * @return void
     */
    public function send()
    {
        $clientInfo = $this->server->getSwooleServer()->getClientInfo($this->frame->getFd());
        $this->server->createGroup('test');
        $this->server->joinGroup('test', $this->frame->getFd());
        $message = '[' . ($clientInfo['remote_ip'] ?? '') . ':' . ($clientInfo['remote_port'] ?? '') . ']: ' . $data->message;
        return [
            'success'   =>  true,
            'data'      =>  $message,
        ];
    }
    /**
     * 发送消息
     *
     * @WSAction
     * @WSRoute({"action"="joinMaiWei"})
     * @param 
     * @return void
     */
    public function joinMaiWei($data)
    {
//        $count = $this->server->getGroup('room'.$data['room'])->count();
//        //等于null 或 小于 8直接加入分组
//        if ($count ==null or $count < 8) {
            //加入分组
        $this->server->joinGroup('room'.$data['room'], $this->frame->getFd());
        //获取分组的所有fd
        $Fds=$this->server->getGroup('room'.$data['room'])->getFds();
//            Server::sendToGroup('room'.$data['room'],['name'=> 777]);
        $this->RoomGroupService->pushRoomMaiWeiinfo($Fds,'room'.$data['room']);
        return [
            'success'   =>  true,
            'data' => 666
        ];
//        }
    }

    /**
     * Date: 2021/6/1
     * Time: 10:02
     * @WSAction
     * @WSRoute({"action"="WorldChat"})
     */
    public function WorldChat($data)
    {

        $this->server->joinGroup('WorldChat', $this->frame->getFd());
        $this->RedisService->setRedislpush('indexbroadcast',$data);
        $this->server->groupCall('WorldChat', 'push', $data);
    }

    /**
     * Date: 2021/6/1
     * Time: 16:19
     * @WSAction
     * @WSRoute({"action"="MatchingOneOnOne"})
     * @param $data
     */
    public function MatchingOneOnOne($data)
    {
        $data=json_decode($data,true);
        $this->server->joinGroup( 'MatchingOneOnOne_'.$data['send_id'], $this->frame->getFd());
        $this->server->getGroup('MatchingOneOnOne_'.$data['send_id'])->isInGroup($this->frame->getFd());
    }

}
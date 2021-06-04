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
     * 发送消息
     *
     * @WSAction
     * @WSRoute({"action"="send"})
     * @param 
     * @return void
     */
    public function send($data)
    {
        $this->server->joinGroup('', $this->frame->getFd());
        $this->server->getSwooleServer()->bind();
        $clientInfo = $this->server->getSwooleServer()->getClientInfo($this->frame->getFd());
        $message = '[' . ($clientInfo['remote_ip'] ?? '') . ':' . ($clientInfo['remote_port'] ?? '') . ']: ' . $data->message;
        return [
            'success'   =>  true,
            'data'      =>  $message,
        ];
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
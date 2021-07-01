<?php
namespace ImiApp\MainServer\HttpController;

use Imi\ConnectContext;
use Imi\Controller\HttpController;
use Imi\Db\Db;
use Imi\Server\Session\Session;
use Imi\Server\View\Annotation\View;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;
use Imi\Server\Route\Annotation\WebSocket\WSConfig;
use Imi\ServerManage;

/**
 * 测试
 * @Controller
 * @View(renderType="html")
 */
class HandShakeController extends HttpController
{
    /**
     * 
     * @Action
     * @Route("/ws")
     * @WSConfig(parserClass=\Imi\Server\DataParser\JsonArrayParser::class)
     * @return void
     */
    public function ws()
    {
        $user_id=Session::get('user_id');
        $room_id=$this->request->get('room_id');
        ConnectContext::set('memberId', $user_id);
        $fd = $this->request->getSwooleRequest()->fd;
        ConnectContext::set($fd,$user_id);
//        ConnectContext::set('usefd'.$fd,$user_id);
        ConnectContext::set($user_id,$room_id);
        //绑定fd和uid
        ServerManage::getServer('main')->getSwooleServer()->bind($fd,$user_id);
        //增加直播间人数
        Db::query()->table('room')->where('roomnumber','=',$room_id)
            ->setFieldInc('audience',1)->update();
    }
    
}
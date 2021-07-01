<?php


namespace ImiApp\Listener;

use Imi\ConnectContext;
use Imi\Aop\Annotation\Inject;
use Imi\Bean\Annotation\ClassEventListener;
use Imi\Db\Db;
use Imi\Server\Event\Param\CloseEventParam;
use Imi\Server\Event\Listener\ICloseEventListener;
/**
 * @ClassEventListener(className="Imi\Server\WebSocket\Server", eventName="close")
 */
class WebSockerOnClose implements ICloseEventListener
{

    /**
     * 事件处理方法
     * @param CloseEventParam $e
     * @return void
     */
    public function handle(CloseEventParam $e)
    {
        /** @var \Imi\Server\Http\Route\RouteResult $httpRouteResult */
        $httpRouteResult = ConnectContext::get('httpRouteResult');
        if('/ws' === ($httpRouteResult->routeItem->annotation->url ?? null))
        {
            $memberId = ConnectContext::get('memberId');
            $room_id=ConnectContext::get($memberId);
            Db::query()->table('room')->where('roomnumber','=',$room_id)
                ->setFieldDec('audience',1)->update();
        }
    }
}
<?php
namespace ImiApp\MainServer\HttpController;

use Imi\ConnectContext;
use Imi\Controller\HttpController;
use Imi\Server\Session\Session;
use Imi\Server\View\Annotation\View;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;
use Imi\Server\Route\Annotation\WebSocket\WSConfig;

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
        var_dump($user_id);
        ConnectContext::set('memberId', $user_id);
        $flag = 'im-' . $user_id;
        $currentFd = $this->request->getSwooleRequest()->fd;
        if(!ConnectContext::bindNx($flag, $currentFd))
        {
            $fd = ConnectContext::getFdByFlag($flag);
            if($fd)
            {
                $this->request->getServerInstance()->getSwooleServer()->close($fd);
            }
            if(!ConnectContext::bindNx($flag, $currentFd))
            {
                $this->request->getServerInstance()->getSwooleServer()->close($currentFd);
            }
        }
        
    }
    
}
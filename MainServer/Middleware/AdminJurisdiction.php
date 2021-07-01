<?php


namespace ImiApp\MainServer\Middleware;


use Imi\Server\Route\Annotation\Middleware;
use Imi\Server\Session\Session;
use ImiApp\MainServer\Exception\BusinessException;
use ImiApp\MainServer\Model\Adminuser;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminJurisdiction extends Middleware
{
    //中间件验证用户是否有这个权限
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $params=$request->getUri();
        //获取请求参数
        $paramsquery=$params->getQuery();
        $arr=explode('&',$paramsquery);
        $moudle_id=substr($arr['0'],'7');
        $node_id=substr($arr['1'],'5');
        if($moudle_id=='' or $node_id=='')
        {
            throw new BusinessException('权限错误');
        }
        $info=Adminuser::find(1);
        $jurisdiction=json_decode($info->getJurisdiction(),true);
        if(!$jurisdiction==0){
            if(strpos(implode($jurisdiction[$moudle_id-1]['path']),$node_id) ==false)
            {
                throw new BusinessException('权限验证失败,请联系管理员');
            }
        }
        return  $handler->handle($request);
    }
}
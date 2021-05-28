<?php


namespace ImiApp\MainServer\AdminController;


use Imi\Controller\SingletonHttpController;
use Imi\AC\AccessControl\Operation;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;
use Imi\AC\AccessControl\Role;
use Imi\JWT\Facade\JWT;
/**
 * Class AcController
 * @package ImiApp\MainServer\AdminController
 * @Controller("/Ac/");
 */
class AcController extends SingletonHttpController
{
    /**
     * Date: 2021/5/27
     * Time: 15:01
     * @Action
     * @Route(method="POST")
     */
    public function setOperation()
    {
        $id=Operation::create('添加管理员');
        $role_id=Role::create('添加管理员角色');
        $token = JWT::getToken(); // 仅验证是否合法
        $token->__toString();
        // $token = JWT::parseToken($jwt, 'a'); // 指定配置名称
        $data = $token->getClaim('data'); // 获取往token里丢的数据
        $validationData = new \Lcobucci\JWT\ValidationData;
        $validationData->setId('');
        return [
            'data' => [
                'id'=>$id,
                'role_id' =>$role_id
            ]
        ];
    }
}
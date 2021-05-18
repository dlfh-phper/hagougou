<?php


namespace ImiApp\MainServer\HttpController;

use Imi\Controller\SingletonHttpController;
use Imi\Listener\Init;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;
use Imi\HttpValidate\Annotation\HttpValidation;
use Imi\Validate\Annotation\Integer;
use Imi\Validate\Annotation\Required;
use Imi\Validate\Annotation\Regex;
/**
 * @Controller("/User/")
 */
class UserController extends SingletonHttpController
{
    /**
     * Date: 2021/5/18
     * Time: 11:10
     *
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="phone", message="手机号不能为空")
     * @Required(name="code", message="验证码不能为空")
     * @Integer(name="code", min="1", message="验证码不能为负")
     * @return void
     */
    public function login(string $phone,string $code)
    {
        return [
            'data'=>'sssss'
        ];
    }
}
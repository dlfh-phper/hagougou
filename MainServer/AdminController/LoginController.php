<?php


namespace ImiApp\MainServer\AdminController;


use Imi\Controller\SingletonHttpController;
use Imi\Server\Route\Annotation\Controller;
use Imi\HttpValidate\Annotation\HttpValidation;
use Imi\Validate\Annotation\Regex;
use Imi\Validate\Annotation\Text;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Middleware;
use Imi\Aop\Annotation\Inject;
use Imi\Server\Session\Session;
use Imi\Validate\Annotation\Integer;
use Imi\Validate\Annotation\Required;

/**
 * Class LoginController
 * @package ImiApp\MainServer\AdminController
 * @Controller("/AdminLogin/")
 */
class LoginController  extends SingletonHttpController
{
    /**
     * @var
     * @Inject("AdminUserService");
     */
    protected $AdminUserService;
    /**
     * Date: 2021/5/28
     * Time: 13:49
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="account", message="账号不能为空")
     * @Required(name="password", message="密码不能为空")
     */
    public function login(string $account,string $password)
    {
        $ip=$this->request->getServerParam('remote_addr');
        $this->AdminUserService->adminUserLogin($account,$password,$ip);
        return [
            'data' =>Session::getID(),
        ];

    }

    /**
     * Date: 2021/5/28
     * Time: 14:21
     * @Action
     * @Route(method="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @HttpValidation
     * @Required(name="account", message="账号不能为空")
     * @Required(name="password", message="密码不能为空")
     * @Required(name="jurisdiction", message="权限不能为空")
     * @param string $account
     * @param string $password
     * @param string $jurisdiction
     * @return array
     */
    public function setAdminUser(string $account,string $password,string $jurisdiction)
    {
        $ip=$this->request->getServerParam('remote_addr');
        return [
            'data' => $this->AdminUserService->AdminUserRegister($account,$password,$jurisdiction,$ip),
        ];
    }

    /**
     * Date: 2021/5/31
     * Time: 14:00
     * @Action
     * @Route(method="POST")
     * 清除Session_id的信息
     */
    public function signout()
    {
        Session::clear();
    }
}
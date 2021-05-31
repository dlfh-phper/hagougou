<?php


namespace ImiApp\MainServer\HttpController;

use Imi\Controller\SingletonHttpController;
use Imi\Listener\Init;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;
use Imi\HttpValidate\Annotation\HttpValidation;
use Imi\Server\Session\Session;
use Imi\Validate\Annotation\Integer;
use Imi\Validate\Annotation\Required;
use Imi\Validate\Annotation\Regex;
use Imi\Aop\Annotation\Inject;
/**
 * @Controller("/User/")
 */
class UserController extends SingletonHttpController
{

    /**
     * @Inject("UserService")
     * @var ImiApp\MainServer\Service\UserService;
     */
    protected $UserService;
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
        $ip = $this->request->getServerParam('remote_addr');
        $this->UserService->login($phone,$ip,$code);
//        $this->UserService->login($phone,$ip,$code)
        return [
            'data'=> Session::getID(),
        ];
    }

    /**
     * Date: 2021/5/18
     * Time: 14:30
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="phone", message="手机号不能为空")
     * @Required(name="wxdata", message="微信参数不能为空")
     * @param array $data
     * @param string $phone
     */
    public function wxlogin(array $wxdata,string $phone)
    {
        $ip = $this->request->getServerParam('remote_addr');
        $this->UserService->wxlogin($phone,$ip,$wxdata);
        return [
            'data'=>Session::getID(),
        ];
    }

    /**
     * Date: 2021/5/18
     * Time: 15:25
     * @Action
     * @Route(method="POST")
     * @param array $qqdata
     * @param string $phone
     * @return array
     */
    public function Qqlogin(array $qqdata,string $phone)
    {
        $ip = $this->request->getServerParam('remote_addr');
        $this->UserService->qqlogin($phone,$ip,$qqdata);
        return [
            'data'=>Session::getID(),
        ];
    }

    /**
     * Date: 2021/5/28
     * Time: 13:44
     * @Action
     * @Route(method="POST")
     * @return array
     */
    public function getUserinfo()
    {
        return [
          'data' => $this->UserService->getUserInfo(Session::get('user_id')),
        ];
    }
}
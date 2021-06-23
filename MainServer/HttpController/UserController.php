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
    public function login(string $phone, string $code)
    {
        $ip = $this->request->getServerParam('remote_addr');
        $this->UserService->login($phone, $ip, $code);

//        $this->UserService->login($phone,$ip,$code)
        return [
            'data' => Session::getID(),
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
    public function wxlogin(string $wxdata, string $phone)
    {
        $ip = $this->request->getServerParam('remote_addr');
        $this->UserService->wxlogin($phone, $ip, $wxdata);
        return [
            'data' => Session::getID(),
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
    public function Qqlogin(string $qqdata, string $phone)
    {
        $ip = $this->request->getServerParam('remote_addr');
        $this->UserService->qqlogin($phone, $ip, $qqdata);
        return [
            'data' => Session::getID(),
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

    /**
     * Date: 2021/6/9
     * Time: 16:04
     * @Action
     * @Route(method="POST")
     * @param int $follow_id
     */
    public function followUser(int $follow_id)
    {
        $this->UserService->followUser(Session::get('user_id'),$follow_id);
    }

    /**
     * Date: 2021/6/9
     * Time: 16:15
     * @Action
     * @Route(method="POST")
     * @param string $nickname
     * @param string $head
     * @param int $sex
     * @param string $autograph
     * @param string $region
     * @param string $birthday
     */
    public function setUserinfo(string $nickname,string $head,int $sex,string $autograph,string $region,string $birthday)
    {
        $this->UserService->setUserinfo($nickname,$head,$sex,$autograph,$region,$birthday,Session::get('user_id'));
    }

    /**
     * Date: 2021/6/23
     * Time: 14:00
     * @Action
     * @Route(method="POST")
     * @return array
     */
    public function UidgetUserinfo($uid)
    {
        return [
            'data' => $this->UserService->getUserInfo($uid),
        ];
    }
}
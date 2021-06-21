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
 * Class Member
 * @package ImiApp\MainServer\AdminController
 * @Controller("/Member/")
 */
class Member extends SingletonHttpController
{
    /**
     * @var
     * @Inject("UserService");
     */
    protected $UserService;
    /**
     * @var
     * @Inject("AdminUserService");
     */
    protected $AdminUserService;
    /**
     * Date: 2021/6/3
     * Time: 14:37
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="page", default="1")
     * @Required(name="page_size", default="10")
     * @param int $page
     * @param int $page_size
     * @return array
     */
    public function getMemberlist(int $page,int $page_size)
    {
        return [
            'data' => $this->UserService->getMemberlist($page,$page_size,'user_id'),
        ];
    }

    /**
     * Date: 2021/6/3
     * Time: 14:43
     * @Action
     * @Route(method="POST")
     * @param int $user_id
     * @return array
     * 用户详情
     */
    public function getMemberInfo(int $user_id)
    {
        return [
          'data' => $this->UserService->getUserInfo($user_id)
        ];
    }

    /**
     * Date: 2021/6/3
     * Time: 14:45
     * @Action
     * @Route(method="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @param int $user_id
     * @param int $status
     * @return array
     * 设置用户状态
     */
    public function setMemberStatus(int $user_id,int $status)
    {
        return [
            'data' => $this->UserService->setMemberStatus($user_id,$status)
        ];
    }

    /**
     * Date: 2021/6/21
     * Time: 9:47
     * @Action
     * @Route(method="POST")
     * @param int $page
     * @param int $page_size
     * @return array
     */
    public function getAdminUserList(int $page,int $page_size)
    {
        return [
            'data' => $this->AdminUserService->getAdminUserList($page,$page_size)
        ];
    }
}
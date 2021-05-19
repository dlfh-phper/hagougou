<?php


namespace ImiApp\MainServer\Service;


use Imi\Aop\Annotation\Inject;
use Imi\ConnectContext;
use Imi\RequestContext;
use Imi\Server\Session\Session;

class UserSessionService
{
    /**
     * @Inject("UserSercive")
     * @var
     */
    protected $UserSercive;
    /**
     * 用户id
     */
    protected $UserId;
    /**
     * 用户信息
     */
    protected $UserInfo;

    public function __init()
    {

    }

    /**
     * Date: 2021/5/19
     * Time: 15:42
     * 初始化
     */
    public function init()
    {
        if($fd = RequestContext::get('fd'))
        {
            $memberId = ConnectContext::get('memberId', null, $fd);
        }
        else
        {
            $memberId = false;
        }
        if(!$memberId)
        {
            $memberId = Session::get('memberId');
        }
        if(!$memberId)
        {
            return;
        }
        $this->memberId = $memberId;
    }

    /**
     * Date: 2021/5/19
     * Time: 15:43
     * 获取用户信息
     */
    public function getUserInfo()
    {
        if(!$this->UserInfo)
        {
            $this->UserInfo=$this->UserSercive->getUserInfo($this->UserId);
        }
        return $this->UserInfo;
    }

    /**
     * Date: 2021/5/19
     * Time: 15:45
     * @return mixed
     * 获取用户id
     */
    public function getUserId()
    {
        return $this->UserId;
    }
}
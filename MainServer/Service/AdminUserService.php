<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use Imi\Server\Session\Session;
use ImiApp\MainServer\Exception\BusinessException;
use ImiApp\MainServer\Exception\NotFoundException;
use ImiApp\MainServer\Model\Adminuser;

/**
 * Class AdminUserService
 * @package ImiApp\MainServer\Service
 * @Bean("AdminUserService")
 */
class AdminUserService
{
    /**
     * Date: 2021/5/28
     * Time: 14:04
     * @param string $account
     * @param string $password
     * @param string $ip
     * @throws NotFoundException
     */
    public function adminUserLogin(string $account,string $password,string $ip)
    {
        $record=$this->getByaccount($account);
        if($record){
            if(password_verify($password,$record->getPassword())){
                $record->ip=$ip;
                $record->login_time=time();
                $record->save();
                Session::set('adminuser_id',$record->admin_id);
            }else{
                throw new NotFoundException(sprintf('账户或密码错误, 请查证后在登录 %s'));
            }
        }else{
            throw new NotFoundException(sprintf('用户不存在 %s'));
        }

    }

    /**
     * Date: 2021/5/28
     * Time: 14:20
     * @param string $account
     * @return Adminuser|null
     * 通过账号查找用户；
     */
    public function getByaccount(string $account)
    {
        return Adminuser::find(['account'=>$account]);
    }

    /**
     * Date: 2021/5/28
     * Time: 14:21
     * @param string $account
     * @param string $password
     * @param string $jurisdiction
     * @param string $ip
     * @throws BusinessException
     * 判断账户有没有注册，注册就抛出异常
     */
    public function AdminUserRegister(string $account,string $password,string $jurisdiction,string $ip)
    {
        $record =$this->getByaccount($account);
        if($record)
        {
            throw new BusinessException('账户已存在');
        }
        $result=Adminuser::newInstance();
        $result->setAccount($account);
        $result->setPassword(password_hash($password, PASSWORD_BCRYPT));
        $result->setJurisdiction($jurisdiction);
        $result->setIp($ip);
        $result->setLoginTime(time());
        $result->setAddTime(time());
        $result->setStatus(1);
        $result->insert();
    }
}
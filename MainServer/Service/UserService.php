<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Exception\NotFoundException;
use ImiApp\MainServer\Model\User;

/**
 * @Bean("UserService")
 */
class UserService
{
    public function register()
    {

    }
    public function login(string $phone,string $code)
    {
        $info=$this->getByPhone($phone);
    }
    public function getByPhone(string $phone)
    {
        $info=User::find(['phone'=>$phone]);
        if($info){
            return $info;
        }
    }
}
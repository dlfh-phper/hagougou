<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use Imi\Server\Session\Session;
use ImiApp\MainServer\Exception\BusinessException;
use ImiApp\MainServer\Exception\NotFoundException;
use ImiApp\MainServer\Helper\Helper;
use ImiApp\MainServer\Model\User;
use \Imi\JWT\Facade\JWT;
use ImiApp\MainServer\Model\Wechat;

/**
 * Class UserService
 * @package ImiApp\MainServer\Service
 * @Bean("UserService")
 */
class UserService
{
    /**
     * Date: 2021/5/18
     * Time: 14:32
     * @param string $phone
     * @param string $ip
     * 注册
     */
    public function register(string $phone, string $ip,$data)
    {
        $randid=substr($phone,'3','2').substr($phone,'-1','3');
        $info=User::newInstance();
        $info->setHead('https://hagougou.oss-cn-shanghai.aliyuncs.com/uplaod/image/20210602/5484f80d6b6a5ce47582760a1e4a08b30fc04fcb.png');
        $info->setNickname('新手用户'.$randid);
        $info->setPhone($phone);
        $info->setIp($ip);
        $info->setRegisterTime(time());
        $info->setLastTime(time());
        $info->setLoginTime(time());
        $info->setWxopenid($data['openid'] ?? '');
        $info->setQqopenid($data['openid'] ?? '');
        $info->setWxhead($data['head'] ?? '');
        $info->setQqhead($data['head'] ?? '');
        $info->setWxname($data['name'] ?? '');
        $info->setQqname($data['name'] ?? '');
        $info->setRandId($randid);
        $info->insert();
        Session::set('user_id',$info->getId());
//        $token = JWT::getToken($info->getId(),'haihai');
//        return $token->__toString();
    }

    /**
     * Date: 2021/5/18
     * Time: 14:32
     * @param string $phone
     * @param string $code
     * @param string $ip
     * @throws BusinessException
     * 验证码登录
     */
    public function login(string $phone,string $ip,string $code)
    {
        $info=$this->getByPhone($phone);
        if($info){
            //账号存在就验证验证码，正确登录更新登陆时间，上次登录时间。登录IP地址
            if(Helper::VerificationCode($code)==true)
            {
                //登录之后修改用户登陆时间，上次登录时间，IP地址
                $this->setUserInfo($ip,$info->getUserId());
                Session::set('user_id',$info->getUserId());
            }else{
               throw new BusinessException('验证码错误');
            }
        }else{
            $data=[];
            //不存在就注册
            $this->register($phone,$ip,$data);
        }
    }

    /**
     * Date: 2021/5/18
     * Time: 15:39
     * @param string $phone
     * @param string $ip
     * @param array $wxdata
     * @throws BusinessException
     * 微信授权登录
     */
    public function wxlogin(string $phone,string $ip,array $wxdata)
    {
        $info=$this->getByPhone($phone);
        if($info)
        {
             //用户信息存在openid=空说明手机号已经注册，没有使用微信登录，首次使用微信登录绑定微信昵称，头像，openid
            if($info->getWxopenid()==''){
                $info->setWxhead($wxdata['head']);
                $info->setWxname($wxdata['nickName']);
                $info->setWxopenid($wxdata['openid']);
                $info->update();
            }else{
                //如果openid和数据库的openid不一致说明不是用一个微信号，不让登陆
                if($info->getWxopenid()==$wxdata['openid'])
                {
                    $this->setUserInfo($ip,$info->getUserId());
                    Session::set('user_id',$info->getUserId());
                }else{
                    throw new BusinessException('微信信息错误,请使用正确的微信号码');
                }
            }
        }else{
            $this->register($phone,$ip,$wxdata);
        }
    }

    /**
     * Date: 2021/5/18
     * Time: 15:25
     * @param string $phone
     * @param string $ip
     * @param array $qqdata
     * @throws BusinessException
     * qq登录，和微信逻辑一样
     */
    public function qqlogin(string $phone,string $ip,array $qqdata)
    {
        $info=$this->getByPhone($phone);
        if($info)
        {
            //用户信息存在openid=空说明手机号已经注册，没有使用微信登录，首次使用微信登录绑定微信昵称，头像，openid
            if($info->getQqopenid()==''){
                $info->setQqhead($qqdata['head']);
                $info->setQqname($qqdata['nickName']);
                $info->setQqopenid($qqdata['openid']);
                $info->update();
            }else{
                //如果openid和数据库的openid不一致说明不是用一个微信号，不让登陆
                if($info->getQqopenid()==$qqdata['openid'])
                {
                    $this->setUserInfo($ip,$info->getUserId());
                    Session::set('user_id',$info->getUserId());
//                    $token = JWT::getToken($info->getUserId(),'haihai');
//                    return $token->__toString();
                }else{
                    throw new BusinessException('微信信息错误,请使用正确的微信号码');
                }
            }
        }else{
            $this->register($phone,$ip,$qqdata);
        }
    }
    /**
     * Date: 2021/5/18
     * Time: 14:34
     * @param string $phone
     * @return User
     * 根据手机号获取用户信息
     */
    public function getByPhone(string $phone)
    {
        $info=User::find(['phone'=>$phone]);
        if($info){
            return $info;
        }
    }

    /**
     * Date: 2021/5/18
     * Time: 14:38
     * 更新用户登录信息
     */
    public function setUserInfo($ip,$id)
    {
        $info=User::find($id);
        $info->setIp($ip);
        $info->setLastTime($info->getLoginTime());
        $info->setLoginTime(time());
        $info->update();
    }

    /**
     * Date: 2021/5/19
     * Time: 11:04
     * @return \Imi\Db\Query\Interfaces\IQuery
     * 首页推荐用户，随机返回两条
     */
    public function getRandUserinfo(int $num)
    {
        $count=User::count('user_id');
        $info=User::query()->page(mt_rand(1,$count),$num)->select()->getArray();
        foreach ($info as $key=>$value)
        {
            $info[$key]['dynamic']=Wechat::query()->where('uid','=',$value['user_id'])->order('id','desc')->page(0,3)->select()->getArray();
        }
        return $info;
    }

    /**
     * Date: 2021/5/19
     * Time: 15:48
     * @param int $id
     * @return User|null
     * 用户信息
     */
    public function getUserInfo(int $id)
    {
        $info=User::find(['user_id'=>$id]);
        return $info;

    }

    /**
     * Date: 2021/5/24
     * Time: 14:52
     * @param string $Search
     * @return \Imi\Db\Query\Interfaces\IResult
     * 用户昵称 编号搜索
     */
    public function nickNameAndIdSearch(string $Search,string $page,string $page_size)
    {
        $info=User::query()->whereRaw("nickname LIKE '%{$Search}%' OR user_id LIKE '%{$Search}%'")->page(($page-1)*$page_size,$page_size)->order('user_id','desc')->select()->getArray();
        $count=User::query()->whereRaw("nickname LIKE '%{$Search}%' OR user_id LIKE '%{$Search}%'")->select()->getRowCount();
        return [
            'list'=>$info,
            'count'=>$count
        ];
    }
}
<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use Imi\Server\Session\Session;
use ImiApp\Enum\MessageCode;
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
    public function register(string $phone, string $ip, $data)
    {
        $randid = substr($phone, '3', '2').substr($phone, -3);
        $info = User::newInstance();
        $info->setHead('https://hagougou.oss-cn-shanghai.aliyuncs.com/uplaod/image/20210602/5484f80d6b6a5ce47582760a1e4a08b30fc04fcb.png');
        $info->setNickname('新手用户'.$randid);
        $info->setPhone($phone);
        $info->setIp($ip);
        $info->setRegisterTime(time());
        $info->setLastTime(time());
        $info->setLoginTime(time());
        $info->setWxopenid($data['openId'] ?? '');
        $info->setQqopenid($data['qqopenid'] ?? '');
        $info->setWxhead($data['avatarUrl'] ?? '');
        $info->setQqhead($data['qqhead'] ?? '');
        $info->setWxname($data['nickName'] ?? '');
        $info->setQqname($data['qqname'] ?? '');
        $info->setRandId($randid);
        $info->setStatus(1);
        $info->insert();
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
    public function login(string $phone, string $ip, string $code)
    {
        $info = $this->getByPhone($phone);
        if ($info) {
            //账号存在就验证验证码，正确登录更新登陆时间，上次登录时间。登录IP地址
            if (Helper::VerificationCode($code) == true) {
                //登录之后修改用户登陆时间，上次登录时间，IP地址
                $this->setUserInfo($ip, $info->getUserId());
                Session::set('user_id', $info->getUserId());
            } else {
                throw new BusinessException('验证码错误');
            }
        } else {
            $data = [];
            //不存在就注册
            $this->register($phone, $ip, $data);
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
    public function wxlogin(string $phone, string $ip, string $wxdata)
    {
        $wxdata = json_decode($wxdata, true);
        $info = $this->getByOpenid('wxopenid', $wxdata['openId']);
        if ($info) {
            Session::set('user_id', $info->getUserId());
        } else {
            //手机号等于空不允许注册
            if ($phone == '') {
                throw new BusinessException('false',MessageCode::SUCCESS);   
            } else {
                //先判判断手一家伙存不存在数据库里面，存在设置一下微信头像
                $member = $this->getByPhone($phone);
                if ($member) {
                    $member->setWxhead($wxdata['avatarUrl']);
                    $member->setWxname($wxdata['nickName']);
                    $member->setWxopenid($wxdata['openId']);
                    $member->update();
                    Session::set('user_id', $member->getUserId());
                } else {
                    $this->register($phone, $ip, $wxdata);
                }

            }

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
    public function qqlogin(string $phone, string $ip, string $qqdata)
    {

        $qqdata = json_decode($qqdata, true);
        $info = $this->getByOpenid('qqopenid', $qqdata['openId']);
        if ($info) {
            Session::set('user_id', $info->getUserId());
        } else {
            if ($phone == '') {
                throw new BusinessException('false',MessageCode::SUCCESS);
            } else {
                $member = $this->getByPhone($phone);
                if ($member) {
                    $member->setQqhead($qqdata['avatarUrl']);
                    $member->setQqname($qqdata['nickName']);
                    $member->setQqopenid($qqdata['openId']);
                    $member->update();
                    Session::set('user_id', $member->getUserId());
                } else {
                    $data['qqhead']=$qqdata['avatarUrl'];
                    $data['qqname']=$qqdata['nickName'];
                    $data['qqopenid']=$qqdata['openId'];
                    $this->register($phone, $ip, $data);
                }
            }
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
        $info = User::find(['phone' => $phone]);
        if ($info) {
            return $info;
        }
    }

    /**
     * Date: 2021/6/8
     * Time: 11:23
     * @param string $field
     * @param string $openid
     * @return User|null
     * 通过opendi 或者qqopenid获取信息
     */
    public function getByOpenid(string $field, string $openid)
    {
        return User::find(["$field" => $openid]);
    }

    /**
     * Date: 2021/5/18
     * Time: 14:38
     * 更新用户登录信息
     */
    public function setUserInfo($ip, $id)
    {
        $info = User::find($id);
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
        $count = User::count('user_id');
        $info = User::query()->page(mt_rand(1, $count), $num)->select()->getArray();
        foreach ($info as $key => $value) {
            $info[$key]['dynamic'] = Wechat::query()->where('uid', '=', $value['user_id'])->order('id', 'desc')->page(0,
                3)->select()->getArray();
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
        $info = User::find(['user_id' => $id]);

        return $info;

    }

    /**
     * Date: 2021/5/24
     * Time: 14:52
     * @param string $Search
     * @return \Imi\Db\Query\Interfaces\IResult
     * 用户昵称 编号搜索
     */
    public function nickNameAndIdSearch(string $Search, string $page, string $page_size)
    {
        $info = User::query()->whereRaw("nickname LIKE '%{$Search}%' OR user_id LIKE '%{$Search}%'")->page(($page - 1) * $page_size,
            $page_size)->order('user_id', 'desc')->select()->getArray();
        $count = User::query()->whereRaw("nickname LIKE '%{$Search}%' OR user_id LIKE '%{$Search}%'")->select()->getRowCount();

        return [
            'list' => $info,
            'count' => $count,
        ];
    }

    /**
     * Date: 2021/6/3
     * Time: 14:39
     * @param int $page
     * @param int $page_size
     * 用户列表
     */
    public function getMemberlist(int $page, int $page_size, string $field)
    {
        $list = User::query()->page(($page - 1) * $page_size, $page_size)->order('user_id',
            'desc')->select()->getArray();
        $count = User::count();

        return [
            'list' => $list,
            'count' => $count,
        ];
    }

    /**
     * Date: 2021/6/3
     * Time: 14:49
     * @param int $user_id
     * @param int $status
     * 设置用户状态
     */
    public function setMemberStatus(int $user_id, int $status)
    {
        $info = User::find($user_id);
        $info->setStatus($status);
        $info->update();
    }
}
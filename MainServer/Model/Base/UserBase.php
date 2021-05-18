<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * user 基类
 * @Entity
 * @Table(name="user", id={"user_id"})
 * @DDL("CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `phone` char(30) NOT NULL COMMENT '注册手机号',
  `nickname` varchar(255) DEFAULT NULL COMMENT '默认昵称',
  `head` varchar(255) DEFAULT NULL COMMENT '默认头像',
  `wxopenid` varchar(255) DEFAULT NULL COMMENT '微信openid',
  `wxhead` varchar(255) DEFAULT NULL COMMENT '微信头像',
  `wxname` varchar(255) DEFAULT NULL COMMENT '微信昵称',
  `qqopenid` varchar(255) DEFAULT NULL COMMENT 'QQopenid',
  `qqhead` varchar(255) DEFAULT NULL COMMENT 'qq头像',
  `qqname` varchar(255) DEFAULT NULL COMMENT 'qq头像',
  `register_time` int(11) NOT NULL COMMENT '注册时间',
  `login_time` int(11) NOT NULL COMMENT '登陆时间',
  `ip` varchar(255) NOT NULL COMMENT '登录ip地址',
  `last_time` int(11) NOT NULL COMMENT '上次登录时间',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $userId 自增id
 * @property string $phone 注册手机号
 * @property string $nickname 默认昵称
 * @property string $head 默认头像
 * @property string $wxopenid 微信openid
 * @property string $wxhead 微信头像
 * @property string $wxname 微信昵称
 * @property string $qqopenid QQopenid
 * @property string $qqhead qq头像
 * @property string $qqname qq头像
 * @property int $registerTime 注册时间
 * @property int $loginTime 登陆时间
 * @property string $ip 登录ip地址
 * @property int $lastTime 上次登录时间
 */
abstract class UserBase extends Model
{
    /**
     * 自增id
     * user_id
     * @Column(name="user_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=true, primaryKeyIndex=0, isAutoIncrement=true)
     * @var int
     */
    protected $userId;

    /**
     * 获取 userId - 自增id
     *
     * @return int
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * 赋值 userId - 自增id
     * @param int $userId user_id
     * @return static
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * 注册手机号
     * phone
     * @Column(name="phone", type="char", length=30, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $phone;

    /**
     * 获取 phone - 注册手机号
     *
     * @return string
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * 赋值 phone - 注册手机号
     * @param string $phone phone
     * @return static
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * 默认昵称
     * nickname
     * @Column(name="nickname", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $nickname;

    /**
     * 获取 nickname - 默认昵称
     *
     * @return string
     */ 
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * 赋值 nickname - 默认昵称
     * @param string $nickname nickname
     * @return static
     */ 
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * 默认头像
     * head
     * @Column(name="head", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $head;

    /**
     * 获取 head - 默认头像
     *
     * @return string
     */ 
    public function getHead()
    {
        return $this->head;
    }

    /**
     * 赋值 head - 默认头像
     * @param string $head head
     * @return static
     */ 
    public function setHead($head)
    {
        $this->head = $head;
        return $this;
    }

    /**
     * 微信openid
     * wxopenid
     * @Column(name="wxopenid", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $wxopenid;

    /**
     * 获取 wxopenid - 微信openid
     *
     * @return string
     */ 
    public function getWxopenid()
    {
        return $this->wxopenid;
    }

    /**
     * 赋值 wxopenid - 微信openid
     * @param string $wxopenid wxopenid
     * @return static
     */ 
    public function setWxopenid($wxopenid)
    {
        $this->wxopenid = $wxopenid;
        return $this;
    }

    /**
     * 微信头像
     * wxhead
     * @Column(name="wxhead", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $wxhead;

    /**
     * 获取 wxhead - 微信头像
     *
     * @return string
     */ 
    public function getWxhead()
    {
        return $this->wxhead;
    }

    /**
     * 赋值 wxhead - 微信头像
     * @param string $wxhead wxhead
     * @return static
     */ 
    public function setWxhead($wxhead)
    {
        $this->wxhead = $wxhead;
        return $this;
    }

    /**
     * 微信昵称
     * wxname
     * @Column(name="wxname", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $wxname;

    /**
     * 获取 wxname - 微信昵称
     *
     * @return string
     */ 
    public function getWxname()
    {
        return $this->wxname;
    }

    /**
     * 赋值 wxname - 微信昵称
     * @param string $wxname wxname
     * @return static
     */ 
    public function setWxname($wxname)
    {
        $this->wxname = $wxname;
        return $this;
    }

    /**
     * QQopenid
     * qqopenid
     * @Column(name="qqopenid", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $qqopenid;

    /**
     * 获取 qqopenid - QQopenid
     *
     * @return string
     */ 
    public function getQqopenid()
    {
        return $this->qqopenid;
    }

    /**
     * 赋值 qqopenid - QQopenid
     * @param string $qqopenid qqopenid
     * @return static
     */ 
    public function setQqopenid($qqopenid)
    {
        $this->qqopenid = $qqopenid;
        return $this;
    }

    /**
     * qq头像
     * qqhead
     * @Column(name="qqhead", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $qqhead;

    /**
     * 获取 qqhead - qq头像
     *
     * @return string
     */ 
    public function getQqhead()
    {
        return $this->qqhead;
    }

    /**
     * 赋值 qqhead - qq头像
     * @param string $qqhead qqhead
     * @return static
     */ 
    public function setQqhead($qqhead)
    {
        $this->qqhead = $qqhead;
        return $this;
    }

    /**
     * qq头像
     * qqname
     * @Column(name="qqname", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $qqname;

    /**
     * 获取 qqname - qq头像
     *
     * @return string
     */ 
    public function getQqname()
    {
        return $this->qqname;
    }

    /**
     * 赋值 qqname - qq头像
     * @param string $qqname qqname
     * @return static
     */ 
    public function setQqname($qqname)
    {
        $this->qqname = $qqname;
        return $this;
    }

    /**
     * 注册时间
     * register_time
     * @Column(name="register_time", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $registerTime;

    /**
     * 获取 registerTime - 注册时间
     *
     * @return int
     */ 
    public function getRegisterTime()
    {
        return $this->registerTime;
    }

    /**
     * 赋值 registerTime - 注册时间
     * @param int $registerTime register_time
     * @return static
     */ 
    public function setRegisterTime($registerTime)
    {
        $this->registerTime = $registerTime;
        return $this;
    }

    /**
     * 登陆时间
     * login_time
     * @Column(name="login_time", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $loginTime;

    /**
     * 获取 loginTime - 登陆时间
     *
     * @return int
     */ 
    public function getLoginTime()
    {
        return $this->loginTime;
    }

    /**
     * 赋值 loginTime - 登陆时间
     * @param int $loginTime login_time
     * @return static
     */ 
    public function setLoginTime($loginTime)
    {
        $this->loginTime = $loginTime;
        return $this;
    }

    /**
     * 登录ip地址
     * ip
     * @Column(name="ip", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $ip;

    /**
     * 获取 ip - 登录ip地址
     *
     * @return string
     */ 
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * 赋值 ip - 登录ip地址
     * @param string $ip ip
     * @return static
     */ 
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * 上次登录时间
     * last_time
     * @Column(name="last_time", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $lastTime;

    /**
     * 获取 lastTime - 上次登录时间
     *
     * @return int
     */ 
    public function getLastTime()
    {
        return $this->lastTime;
    }

    /**
     * 赋值 lastTime - 上次登录时间
     * @param int $lastTime last_time
     * @return static
     */ 
    public function setLastTime($lastTime)
    {
        $this->lastTime = $lastTime;
        return $this;
    }

}
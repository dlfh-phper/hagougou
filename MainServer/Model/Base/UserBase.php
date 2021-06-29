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
  `phone` varchar(255) DEFAULT NULL COMMENT '注册手机号',
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
  `headkuang` int(11) DEFAULT NULL COMMENT '头像框id',
  `rand_id` int(11) NOT NULL COMMENT '用户随机id',
  `wealthvalue` int(11) NOT NULL DEFAULT '0' COMMENT '财富值',
  `charmvalue` int(11) NOT NULL DEFAULT '0' COMMENT '魅力值',
  `balance` int(11) NOT NULL DEFAULT '0' COMMENT '账户余额',
  `status` int(11) NOT NULL,
  `sex` int(11) NOT NULL COMMENT '1男 2 女 3未定义',
  `autograph` varchar(255) NOT NULL COMMENT '签名',
  `region` varchar(255) NOT NULL COMMENT '地区',
  `birthday` varchar(255) NOT NULL COMMENT '生日',
  `realname` int(11) NOT NULL DEFAULT '0' COMMENT '是否实名默认0 实名1',
  `Intimacy` longtext COMMENT '\r\n\r\n亲密关系',
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
 * @property int $headkuang 头像框id
 * @property int $randId 用户随机id
 * @property int $wealthvalue 财富值
 * @property int $charmvalue 魅力值
 * @property int $balance 账户余额
 * @property int $status 
 * @property int $sex 1男 2 女 3未定义
 * @property string $autograph 签名
 * @property string $region 地区
 * @property string $birthday 生日
 * @property int $realname 是否实名默认0 实名1
 * @property string $intimacy 

亲密关系
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
     * @Column(name="phone", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
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

    /**
     * 头像框id
     * headkuang
     * @Column(name="headkuang", type="int", length=11, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $headkuang;

    /**
     * 获取 headkuang - 头像框id
     *
     * @return int
     */ 
    public function getHeadkuang()
    {
        return $this->headkuang;
    }

    /**
     * 赋值 headkuang - 头像框id
     * @param int $headkuang headkuang
     * @return static
     */ 
    public function setHeadkuang($headkuang)
    {
        $this->headkuang = $headkuang;
        return $this;
    }

    /**
     * 用户随机id
     * rand_id
     * @Column(name="rand_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $randId;

    /**
     * 获取 randId - 用户随机id
     *
     * @return int
     */ 
    public function getRandId()
    {
        return $this->randId;
    }

    /**
     * 赋值 randId - 用户随机id
     * @param int $randId rand_id
     * @return static
     */ 
    public function setRandId($randId)
    {
        $this->randId = $randId;
        return $this;
    }

    /**
     * 财富值
     * wealthvalue
     * @Column(name="wealthvalue", type="int", length=11, accuracy=0, nullable=false, default="0", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $wealthvalue;

    /**
     * 获取 wealthvalue - 财富值
     *
     * @return int
     */ 
    public function getWealthvalue()
    {
        return $this->wealthvalue;
    }

    /**
     * 赋值 wealthvalue - 财富值
     * @param int $wealthvalue wealthvalue
     * @return static
     */ 
    public function setWealthvalue($wealthvalue)
    {
        $this->wealthvalue = $wealthvalue;
        return $this;
    }

    /**
     * 魅力值
     * charmvalue
     * @Column(name="charmvalue", type="int", length=11, accuracy=0, nullable=false, default="0", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $charmvalue;

    /**
     * 获取 charmvalue - 魅力值
     *
     * @return int
     */ 
    public function getCharmvalue()
    {
        return $this->charmvalue;
    }

    /**
     * 赋值 charmvalue - 魅力值
     * @param int $charmvalue charmvalue
     * @return static
     */ 
    public function setCharmvalue($charmvalue)
    {
        $this->charmvalue = $charmvalue;
        return $this;
    }

    /**
     * 账户余额
     * balance
     * @Column(name="balance", type="int", length=11, accuracy=0, nullable=false, default="0", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $balance;

    /**
     * 获取 balance - 账户余额
     *
     * @return int
     */ 
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * 赋值 balance - 账户余额
     * @param int $balance balance
     * @return static
     */ 
    public function setBalance($balance)
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * status
     * @Column(name="status", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $status;

    /**
     * 获取 status
     *
     * @return int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 赋值 status
     * @param int $status status
     * @return static
     */ 
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * 1男 2 女 3未定义
     * sex
     * @Column(name="sex", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $sex;

    /**
     * 获取 sex - 1男 2 女 3未定义
     *
     * @return int
     */ 
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * 赋值 sex - 1男 2 女 3未定义
     * @param int $sex sex
     * @return static
     */ 
    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     * 签名
     * autograph
     * @Column(name="autograph", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $autograph;

    /**
     * 获取 autograph - 签名
     *
     * @return string
     */ 
    public function getAutograph()
    {
        return $this->autograph;
    }

    /**
     * 赋值 autograph - 签名
     * @param string $autograph autograph
     * @return static
     */ 
    public function setAutograph($autograph)
    {
        $this->autograph = $autograph;
        return $this;
    }

    /**
     * 地区
     * region
     * @Column(name="region", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $region;

    /**
     * 获取 region - 地区
     *
     * @return string
     */ 
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * 赋值 region - 地区
     * @param string $region region
     * @return static
     */ 
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * 生日
     * birthday
     * @Column(name="birthday", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $birthday;

    /**
     * 获取 birthday - 生日
     *
     * @return string
     */ 
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * 赋值 birthday - 生日
     * @param string $birthday birthday
     * @return static
     */ 
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * 是否实名默认0 实名1
     * realname
     * @Column(name="realname", type="int", length=11, accuracy=0, nullable=false, default="0", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $realname;

    /**
     * 获取 realname - 是否实名默认0 实名1
     *
     * @return int
     */ 
    public function getRealname()
    {
        return $this->realname;
    }

    /**
     * 赋值 realname - 是否实名默认0 实名1
     * @param int $realname realname
     * @return static
     */ 
    public function setRealname($realname)
    {
        $this->realname = $realname;
        return $this;
    }

    /**
     * 

亲密关系
     * Intimacy
     * @Column(name="Intimacy", type="longtext", length=0, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $intimacy;

    /**
     * 获取 intimacy - 

亲密关系
     *
     * @return string
     */ 
    public function getIntimacy()
    {
        return $this->intimacy;
    }

    /**
     * 赋值 intimacy - 

亲密关系
     * @param string $intimacy Intimacy
     * @return static
     */ 
    public function setIntimacy($intimacy)
    {
        $this->intimacy = $intimacy;
        return $this;
    }

}

<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * adminuser 基类
 * @Entity
 * @Table(name="adminuser", id={"admin_id"})
 * @DDL("CREATE TABLE `adminuser` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) NOT NULL COMMENT '账号',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `jurisdiction` varchar(255) NOT NULL COMMENT '权限',
  `status` int(11) NOT NULL,
  `add_time` int(11) NOT NULL,
  `login_time` int(11) NOT NULL COMMENT '登陆时间',
  `ip` varchar(255) NOT NULL COMMENT 'ip地址',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $adminId 
 * @property string $account 账号
 * @property string $password 密码
 * @property string $jurisdiction 权限
 * @property int $status 
 * @property int $addTime 
 * @property int $loginTime 登陆时间
 * @property string $ip ip地址
 */
abstract class AdminuserBase extends Model
{
    /**
     * admin_id
     * @Column(name="admin_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=true, primaryKeyIndex=0, isAutoIncrement=true)
     * @var int
     */
    protected $adminId;

    /**
     * 获取 adminId
     *
     * @return int
     */ 
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * 赋值 adminId
     * @param int $adminId admin_id
     * @return static
     */ 
    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;
        return $this;
    }

    /**
     * 账号
     * account
     * @Column(name="account", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $account;

    /**
     * 获取 account - 账号
     *
     * @return string
     */ 
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * 赋值 account - 账号
     * @param string $account account
     * @return static
     */ 
    public function setAccount($account)
    {
        $this->account = $account;
        return $this;
    }

    /**
     * 密码
     * password
     * @Column(name="password", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $password;

    /**
     * 获取 password - 密码
     *
     * @return string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * 赋值 password - 密码
     * @param string $password password
     * @return static
     */ 
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * 权限
     * jurisdiction
     * @Column(name="jurisdiction", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $jurisdiction;

    /**
     * 获取 jurisdiction - 权限
     *
     * @return string
     */ 
    public function getJurisdiction()
    {
        return $this->jurisdiction;
    }

    /**
     * 赋值 jurisdiction - 权限
     * @param string $jurisdiction jurisdiction
     * @return static
     */ 
    public function setJurisdiction($jurisdiction)
    {
        $this->jurisdiction = $jurisdiction;
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
     * add_time
     * @Column(name="add_time", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $addTime;

    /**
     * 获取 addTime
     *
     * @return int
     */ 
    public function getAddTime()
    {
        return $this->addTime;
    }

    /**
     * 赋值 addTime
     * @param int $addTime add_time
     * @return static
     */ 
    public function setAddTime($addTime)
    {
        $this->addTime = $addTime;
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
     * ip地址
     * ip
     * @Column(name="ip", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $ip;

    /**
     * 获取 ip - ip地址
     *
     * @return string
     */ 
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * 赋值 ip - ip地址
     * @param string $ip ip
     * @return static
     */ 
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

}

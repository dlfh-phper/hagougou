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
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $adminId 
 * @property string $account 账号
 * @property string $password 密码
 * @property string $jurisdiction 权限
 * @property int $status 
 * @property int $addTime 
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

}

<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * paylog 基类
 * @Entity
 * @Table(name="paylog")
 * @DDL("CREATE TABLE `paylog` (
  `id` int(11) NOT NULL,
  `out_trade_no` varchar(255) NOT NULL COMMENT '订单号',
  `trade_no` varchar(255) NOT NULL COMMENT '支付平台流水',
  `status` int(11) NOT NULL,
  `add_time` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `complete_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property string $outTradeNo 订单号
 * @property string $tradeNo 支付平台流水
 * @property int $status 
 * @property int $addTime 
 * @property string $openid 
 * @property int $completeTime 
 */
abstract class PaylogBase extends Model
{
    /**
     * id
     * @Column(name="id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $id;

    /**
     * 获取 id
     *
     * @return int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * 赋值 id
     * @param int $id id
     * @return static
     */ 
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * 订单号
     * out_trade_no
     * @Column(name="out_trade_no", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $outTradeNo;

    /**
     * 获取 outTradeNo - 订单号
     *
     * @return string
     */ 
    public function getOutTradeNo()
    {
        return $this->outTradeNo;
    }

    /**
     * 赋值 outTradeNo - 订单号
     * @param string $outTradeNo out_trade_no
     * @return static
     */ 
    public function setOutTradeNo($outTradeNo)
    {
        $this->outTradeNo = $outTradeNo;
        return $this;
    }

    /**
     * 支付平台流水
     * trade_no
     * @Column(name="trade_no", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $tradeNo;

    /**
     * 获取 tradeNo - 支付平台流水
     *
     * @return string
     */ 
    public function getTradeNo()
    {
        return $this->tradeNo;
    }

    /**
     * 赋值 tradeNo - 支付平台流水
     * @param string $tradeNo trade_no
     * @return static
     */ 
    public function setTradeNo($tradeNo)
    {
        $this->tradeNo = $tradeNo;
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
     * openid
     * @Column(name="openid", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $openid;

    /**
     * 获取 openid
     *
     * @return string
     */ 
    public function getOpenid()
    {
        return $this->openid;
    }

    /**
     * 赋值 openid
     * @param string $openid openid
     * @return static
     */ 
    public function setOpenid($openid)
    {
        $this->openid = $openid;
        return $this;
    }

    /**
     * complete_time
     * @Column(name="complete_time", type="int", length=11, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $completeTime;

    /**
     * 获取 completeTime
     *
     * @return int
     */ 
    public function getCompleteTime()
    {
        return $this->completeTime;
    }

    /**
     * 赋值 completeTime
     * @param int $completeTime complete_time
     * @return static
     */ 
    public function setCompleteTime($completeTime)
    {
        $this->completeTime = $completeTime;
        return $this;
    }

}

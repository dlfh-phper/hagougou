<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * rechargelog 基类
 * @Entity
 * @Table(name="rechargelog", id={"id"})
 * @DDL("CREATE TABLE `rechargelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(11) NOT NULL COMMENT '充值金额',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `type` varchar(255) NOT NULL COMMENT 'ios 或 Android',
  `out_trade_no` varchar(255) NOT NULL COMMENT '订单号',
  `trade_no` varchar(255) NOT NULL COMMENT '平台流水号',
  `status` int(11) NOT NULL COMMENT '1未支付 2已支付',
  `add_time` int(11) NOT NULL COMMENT '发起支付时间',
  `complete_time` int(11) DEFAULT NULL COMMENT '支付完成时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property int $price 充值金额
 * @property int $uid 用户id
 * @property string $type ios 或 Android
 * @property string $outTradeNo 订单号
 * @property string $tradeNo 平台流水号
 * @property int $status 1未支付 2已支付
 * @property int $addTime 发起支付时间
 * @property int $completeTime 支付完成时间
 */
abstract class RechargelogBase extends Model
{
    /**
     * id
     * @Column(name="id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=true, primaryKeyIndex=0, isAutoIncrement=true)
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
     * 充值金额
     * price
     * @Column(name="price", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $price;

    /**
     * 获取 price - 充值金额
     *
     * @return int
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * 赋值 price - 充值金额
     * @param int $price price
     * @return static
     */ 
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * 用户id
     * uid
     * @Column(name="uid", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $uid;

    /**
     * 获取 uid - 用户id
     *
     * @return int
     */ 
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 赋值 uid - 用户id
     * @param int $uid uid
     * @return static
     */ 
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * ios 或 Android
     * type
     * @Column(name="type", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $type;

    /**
     * 获取 type - ios 或 Android
     *
     * @return string
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * 赋值 type - ios 或 Android
     * @param string $type type
     * @return static
     */ 
    public function setType($type)
    {
        $this->type = $type;
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
     * 平台流水号
     * trade_no
     * @Column(name="trade_no", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $tradeNo;

    /**
     * 获取 tradeNo - 平台流水号
     *
     * @return string
     */ 
    public function getTradeNo()
    {
        return $this->tradeNo;
    }

    /**
     * 赋值 tradeNo - 平台流水号
     * @param string $tradeNo trade_no
     * @return static
     */ 
    public function setTradeNo($tradeNo)
    {
        $this->tradeNo = $tradeNo;
        return $this;
    }

    /**
     * 1未支付 2已支付
     * status
     * @Column(name="status", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $status;

    /**
     * 获取 status - 1未支付 2已支付
     *
     * @return int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 赋值 status - 1未支付 2已支付
     * @param int $status status
     * @return static
     */ 
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * 发起支付时间
     * add_time
     * @Column(name="add_time", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $addTime;

    /**
     * 获取 addTime - 发起支付时间
     *
     * @return int
     */ 
    public function getAddTime()
    {
        return $this->addTime;
    }

    /**
     * 赋值 addTime - 发起支付时间
     * @param int $addTime add_time
     * @return static
     */ 
    public function setAddTime($addTime)
    {
        $this->addTime = $addTime;
        return $this;
    }

    /**
     * 支付完成时间
     * complete_time
     * @Column(name="complete_time", type="int", length=11, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $completeTime;

    /**
     * 获取 completeTime - 支付完成时间
     *
     * @return int
     */ 
    public function getCompleteTime()
    {
        return $this->completeTime;
    }

    /**
     * 赋值 completeTime - 支付完成时间
     * @param int $completeTime complete_time
     * @return static
     */ 
    public function setCompleteTime($completeTime)
    {
        $this->completeTime = $completeTime;
        return $this;
    }

}

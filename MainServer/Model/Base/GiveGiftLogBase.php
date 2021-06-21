<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * give_gift_log 基类
 * @Entity
 * @Table(name="give_gift_log", id={"id"})
 * @DDL("CREATE TABLE `give_gift_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL COMMENT '礼物id',
  `uid` int(11) NOT NULL COMMENT '送礼人',
  `accept_id` int(11) NOT NULL COMMENT '接收人',
  `price` int(11) NOT NULL COMMENT '礼物价格金币',
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property int $shopId 礼物id
 * @property int $uid 送礼人
 * @property int $acceptId 接收人
 * @property int $price 礼物价格金币
 * @property int $addTime 
 */
abstract class GiveGiftLogBase extends Model
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
     * 礼物id
     * shop_id
     * @Column(name="shop_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $shopId;

    /**
     * 获取 shopId - 礼物id
     *
     * @return int
     */ 
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * 赋值 shopId - 礼物id
     * @param int $shopId shop_id
     * @return static
     */ 
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
        return $this;
    }

    /**
     * 送礼人
     * uid
     * @Column(name="uid", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $uid;

    /**
     * 获取 uid - 送礼人
     *
     * @return int
     */ 
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 赋值 uid - 送礼人
     * @param int $uid uid
     * @return static
     */ 
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 接收人
     * accept_id
     * @Column(name="accept_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $acceptId;

    /**
     * 获取 acceptId - 接收人
     *
     * @return int
     */ 
    public function getAcceptId()
    {
        return $this->acceptId;
    }

    /**
     * 赋值 acceptId - 接收人
     * @param int $acceptId accept_id
     * @return static
     */ 
    public function setAcceptId($acceptId)
    {
        $this->acceptId = $acceptId;
        return $this;
    }

    /**
     * 礼物价格金币
     * price
     * @Column(name="price", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $price;

    /**
     * 获取 price - 礼物价格金币
     *
     * @return int
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * 赋值 price - 礼物价格金币
     * @param int $price price
     * @return static
     */ 
    public function setPrice($price)
    {
        $this->price = $price;
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

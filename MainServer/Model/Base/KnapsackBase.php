<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * knapsack 基类
 * @Entity
 * @Table(name="knapsack", id={"id"})
 * @DDL("CREATE TABLE `knapsack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1头像框 2 装扮 3礼物',
  `shop_id` int(11) NOT NULL COMMENT '礼物id',
  `add_time` int(11) NOT NULL COMMENT '购买时间',
  `price` int(11) NOT NULL COMMENT '购买礼物时的金币',
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property int $uid 
 * @property int $type 1头像框 2 装扮 3礼物
 * @property int $shopId 礼物id
 * @property int $addTime 购买时间
 * @property int $price 购买礼物时的金币
 * @property int $count 
 */
abstract class KnapsackBase extends Model
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
     * uid
     * @Column(name="uid", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $uid;

    /**
     * 获取 uid
     *
     * @return int
     */ 
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 赋值 uid
     * @param int $uid uid
     * @return static
     */ 
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 1头像框 2 装扮 3礼物
     * type
     * @Column(name="type", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $type;

    /**
     * 获取 type - 1头像框 2 装扮 3礼物
     *
     * @return int
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * 赋值 type - 1头像框 2 装扮 3礼物
     * @param int $type type
     * @return static
     */ 
    public function setType($type)
    {
        $this->type = $type;
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
     * 购买时间
     * add_time
     * @Column(name="add_time", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $addTime;

    /**
     * 获取 addTime - 购买时间
     *
     * @return int
     */ 
    public function getAddTime()
    {
        return $this->addTime;
    }

    /**
     * 赋值 addTime - 购买时间
     * @param int $addTime add_time
     * @return static
     */ 
    public function setAddTime($addTime)
    {
        $this->addTime = $addTime;
        return $this;
    }

    /**
     * 购买礼物时的金币
     * price
     * @Column(name="price", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $price;

    /**
     * 获取 price - 购买礼物时的金币
     *
     * @return int
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * 赋值 price - 购买礼物时的金币
     * @param int $price price
     * @return static
     */ 
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * count
     * @Column(name="count", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $count;

    /**
     * 获取 count
     *
     * @return int
     */ 
    public function getCount()
    {
        return $this->count;
    }

    /**
     * 赋值 count
     * @param int $count count
     * @return static
     */ 
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

}

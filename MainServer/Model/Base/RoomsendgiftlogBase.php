<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * roomsendgiftlog 基类
 * @Entity
 * @Table(name="roomsendgiftlog", id={"id"})
 * @DDL("CREATE TABLE `roomsendgiftlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomnumber` varchar(255) NOT NULL COMMENT '房间号',
  `uid` int(11) NOT NULL COMMENT '送礼人id',
  `accept_id` int(11) NOT NULL COMMENT '收礼人id',
  `price` int(11) NOT NULL COMMENT '价格金币',
  `shop` int(11) NOT NULL COMMENT '礼物id',
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property string $roomnumber 房间号
 * @property int $uid 送礼人id
 * @property int $acceptId 收礼人id
 * @property int $price 价格金币
 * @property int $shop 礼物id
 * @property int $addTime 
 */
abstract class RoomsendgiftlogBase extends Model
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
     * 房间号
     * roomnumber
     * @Column(name="roomnumber", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $roomnumber;

    /**
     * 获取 roomnumber - 房间号
     *
     * @return string
     */
    public function getRoomnumber()
    {
        return $this->roomnumber;
    }

    /**
     * 赋值 roomnumber - 房间号
     * @param string $roomnumber roomnumber
     * @return static
     */
    public function setRoomnumber($roomnumber)
    {
        $this->roomnumber = $roomnumber;
        return $this;
    }

    /**
     * 送礼人id
     * uid
     * @Column(name="uid", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $uid;

    /**
     * 获取 uid - 送礼人id
     *
     * @return int
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 赋值 uid - 送礼人id
     * @param int $uid uid
     * @return static
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 收礼人id
     * accept_id
     * @Column(name="accept_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $acceptId;

    /**
     * 获取 acceptId - 收礼人id
     *
     * @return int
     */
    public function getAcceptId()
    {
        return $this->acceptId;
    }

    /**
     * 赋值 acceptId - 收礼人id
     * @param int $acceptId accept_id
     * @return static
     */
    public function setAcceptId($acceptId)
    {
        $this->acceptId = $acceptId;
        return $this;
    }

    /**
     * 价格金币
     * price
     * @Column(name="price", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $price;

    /**
     * 获取 price - 价格金币
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * 赋值 price - 价格金币
     * @param int $price price
     * @return static
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * 礼物id
     * shop
     * @Column(name="shop", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $shop;

    /**
     * 获取 shop - 礼物id
     *
     * @return int
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * 赋值 shop - 礼物id
     * @param int $shop shop
     * @return static
     */
    public function setShop($shop)
    {
        $this->shop = $shop;
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

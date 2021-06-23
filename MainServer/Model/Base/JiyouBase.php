<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * 挚友 基类
 * @Entity
 * @Table(name="jiyou", id={"id"})
 * @DDL("CREATE TABLE `jiyou` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `give_id` int(11) NOT NULL COMMENT '送礼物id',
  `accept_id` int(11) NOT NULL COMMENT '接受礼物id',
  `countvalue` int(11) NOT NULL COMMENT '礼物总值',
  `add_time` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='挚友'")
 * @property int $id 
 * @property int $giveId 送礼物id
 * @property int $acceptId 接受礼物id
 * @property int $countvalue 礼物总值
 * @property int $addTime 
 * @property int $shopId 
 */
abstract class JiyouBase extends Model
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
     * 送礼物id
     * give_id
     * @Column(name="give_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $giveId;

    /**
     * 获取 giveId - 送礼物id
     *
     * @return int
     */ 
    public function getGiveId()
    {
        return $this->giveId;
    }

    /**
     * 赋值 giveId - 送礼物id
     * @param int $giveId give_id
     * @return static
     */ 
    public function setGiveId($giveId)
    {
        $this->giveId = $giveId;
        return $this;
    }

    /**
     * 接受礼物id
     * accept_id
     * @Column(name="accept_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $acceptId;

    /**
     * 获取 acceptId - 接受礼物id
     *
     * @return int
     */ 
    public function getAcceptId()
    {
        return $this->acceptId;
    }

    /**
     * 赋值 acceptId - 接受礼物id
     * @param int $acceptId accept_id
     * @return static
     */ 
    public function setAcceptId($acceptId)
    {
        $this->acceptId = $acceptId;
        return $this;
    }

    /**
     * 礼物总值
     * countvalue
     * @Column(name="countvalue", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $countvalue;

    /**
     * 获取 countvalue - 礼物总值
     *
     * @return int
     */ 
    public function getCountvalue()
    {
        return $this->countvalue;
    }

    /**
     * 赋值 countvalue - 礼物总值
     * @param int $countvalue countvalue
     * @return static
     */ 
    public function setCountvalue($countvalue)
    {
        $this->countvalue = $countvalue;
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
     * shop_id
     * @Column(name="shop_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $shopId;

    /**
     * 获取 shopId
     *
     * @return int
     */ 
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * 赋值 shopId
     * @param int $shopId shop_id
     * @return static
     */ 
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
        return $this;
    }

}

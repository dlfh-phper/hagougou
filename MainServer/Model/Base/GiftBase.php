<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * gift 基类
 * @Entity
 * @Table(name="gift", id={"id"})
 * @DDL("CREATE TABLE `gift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL COMMENT '礼物',
  `price` int(11) NOT NULL COMMENT '价格',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `type` int(11) NOT NULL COMMENT '1普通礼物 2亲密值礼物 3cp礼物',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property string $url 礼物
 * @property int $price 价格
 * @property int $addTime 添加时间
 * @property int $type 1普通礼物 2亲密值礼物 3cp礼物
 */
abstract class GiftBase extends Model
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
     * 礼物
     * url
     * @Column(name="url", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $url;

    /**
     * 获取 url - 礼物
     *
     * @return string
     */ 
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * 赋值 url - 礼物
     * @param string $url url
     * @return static
     */ 
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * 价格
     * price
     * @Column(name="price", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $price;

    /**
     * 获取 price - 价格
     *
     * @return int
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * 赋值 price - 价格
     * @param int $price price
     * @return static
     */ 
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * 添加时间
     * add_time
     * @Column(name="add_time", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $addTime;

    /**
     * 获取 addTime - 添加时间
     *
     * @return int
     */ 
    public function getAddTime()
    {
        return $this->addTime;
    }

    /**
     * 赋值 addTime - 添加时间
     * @param int $addTime add_time
     * @return static
     */ 
    public function setAddTime($addTime)
    {
        $this->addTime = $addTime;
        return $this;
    }

    /**
     * 1普通礼物 2亲密值礼物 3cp礼物
     * type
     * @Column(name="type", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $type;

    /**
     * 获取 type - 1普通礼物 2亲密值礼物 3cp礼物
     *
     * @return int
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * 赋值 type - 1普通礼物 2亲密值礼物 3cp礼物
     * @param int $type type
     * @return static
     */ 
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

}

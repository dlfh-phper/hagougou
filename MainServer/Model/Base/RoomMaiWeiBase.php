<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * 直播间麦位 基类
 * @Entity
 * @Table(name="roomMaiWei", id={"id"})
 * @DDL("CREATE TABLE `roomMaiWei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomnumber` varchar(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `add_time` int(11) NOT NULL,
  `desc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='直播间麦位'")
 * @property int $id 
 * @property string $roomnumber 
 * @property int $uid 
 * @property int $addTime 
 * @property int $desc 
 */
abstract class RoomMaiWeiBase extends Model
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
     * roomnumber
     * @Column(name="roomnumber", type="varchar", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $roomnumber;

    /**
     * 获取 roomnumber
     *
     * @return string
     */
    public function getRoomnumber()
    {
        return $this->roomnumber;
    }

    /**
     * 赋值 roomnumber
     * @param string $roomnumber roomnumber
     * @return static
     */
    public function setRoomnumber($roomnumber)
    {
        $this->roomnumber = $roomnumber;
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
     * desc
     * @Column(name="desc", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $desc;

    /**
     * 获取 desc
     *
     * @return int
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * 赋值 desc
     * @param int $desc desc
     * @return static
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
        return $this;
    }

}

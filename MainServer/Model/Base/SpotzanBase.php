<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * spotzan 基类
 * @Entity
 * @Table(name="spotzan", id={"id"})
 * @DDL("CREATE TABLE `spotzan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `w_id` int(11) NOT NULL COMMENT '朋友圈id',
  `uid` int(11) NOT NULL COMMENT '点赞人id',
  `add_time` int(11) NOT NULL COMMENT '时间',
  `have_id` int(11) NOT NULL COMMENT '动态发布者的id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property int $wId 朋友圈id
 * @property int $uid 点赞人id
 * @property int $addTime 时间
 * @property int $haveId 动态发布者的id
 */
abstract class SpotzanBase extends Model
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
     * 朋友圈id
     * w_id
     * @Column(name="w_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $wId;

    /**
     * 获取 wId - 朋友圈id
     *
     * @return int
     */ 
    public function getWId()
    {
        return $this->wId;
    }

    /**
     * 赋值 wId - 朋友圈id
     * @param int $wId w_id
     * @return static
     */ 
    public function setWId($wId)
    {
        $this->wId = $wId;
        return $this;
    }

    /**
     * 点赞人id
     * uid
     * @Column(name="uid", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $uid;

    /**
     * 获取 uid - 点赞人id
     *
     * @return int
     */ 
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 赋值 uid - 点赞人id
     * @param int $uid uid
     * @return static
     */ 
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 时间
     * add_time
     * @Column(name="add_time", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $addTime;

    /**
     * 获取 addTime - 时间
     *
     * @return int
     */ 
    public function getAddTime()
    {
        return $this->addTime;
    }

    /**
     * 赋值 addTime - 时间
     * @param int $addTime add_time
     * @return static
     */ 
    public function setAddTime($addTime)
    {
        $this->addTime = $addTime;
        return $this;
    }

    /**
     * 动态发布者的id
     * have_id
     * @Column(name="have_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $haveId;

    /**
     * 获取 haveId - 动态发布者的id
     *
     * @return int
     */ 
    public function getHaveId()
    {
        return $this->haveId;
    }

    /**
     * 赋值 haveId - 动态发布者的id
     * @param int $haveId have_id
     * @return static
     */ 
    public function setHaveId($haveId)
    {
        $this->haveId = $haveId;
        return $this;
    }

}

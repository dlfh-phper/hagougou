<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * node 基类
 * @Entity
 * @Table(name="node", id={"id"})
 * @DDL("CREATE TABLE `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(255) NOT NULL COMMENT '节点名称',
  `moudle_id` int(11) NOT NULL COMMENT '模块id',
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property string $nodeName 节点名称
 * @property int $moudleId 模块id
 * @property int $addTime 
 */
abstract class NodeBase extends Model
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
     * 节点名称
     * node_name
     * @Column(name="node_name", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $nodeName;

    /**
     * 获取 nodeName - 节点名称
     *
     * @return string
     */ 
    public function getNodeName()
    {
        return $this->nodeName;
    }

    /**
     * 赋值 nodeName - 节点名称
     * @param string $nodeName node_name
     * @return static
     */ 
    public function setNodeName($nodeName)
    {
        $this->nodeName = $nodeName;
        return $this;
    }

    /**
     * 模块id
     * moudle_id
     * @Column(name="moudle_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $moudleId;

    /**
     * 获取 moudleId - 模块id
     *
     * @return int
     */ 
    public function getMoudleId()
    {
        return $this->moudleId;
    }

    /**
     * 赋值 moudleId - 模块id
     * @param int $moudleId moudle_id
     * @return static
     */ 
    public function setMoudleId($moudleId)
    {
        $this->moudleId = $moudleId;
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

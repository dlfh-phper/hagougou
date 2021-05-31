<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * moudle 基类
 * @Entity
 * @Table(name="moudle", id={"id"})
 * @DDL("CREATE TABLE `moudle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '模块名称',
  `add_time` int(255) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property string $name 模块名称
 * @property int $addTime 时间
 */
abstract class MoudleBase extends Model
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
     * 模块名称
     * name
     * @Column(name="name", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $name;

    /**
     * 获取 name - 模块名称
     *
     * @return string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * 赋值 name - 模块名称
     * @param string $name name
     * @return static
     */ 
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * 时间
     * add_time
     * @Column(name="add_time", type="int", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
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

}

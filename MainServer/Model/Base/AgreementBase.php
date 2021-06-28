<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * agreement 基类
 * @Entity
 * @Table(name="agreement", id={"id"})
 * @DDL("CREATE TABLE `agreement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL COMMENT '内容',
  `type` int(11) NOT NULL COMMENT '1用户协议2隐私政策3社区规范',
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property string $content 内容
 * @property int $type 1用户协议2隐私政策3社区规范
 * @property int $addTime 
 */
abstract class AgreementBase extends Model
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
     * 内容
     * content
     * @Column(name="content", type="longtext", length=0, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $content;

    /**
     * 获取 content - 内容
     *
     * @return string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * 赋值 content - 内容
     * @param string $content content
     * @return static
     */ 
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * 1用户协议2隐私政策3社区规范
     * type
     * @Column(name="type", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $type;

    /**
     * 获取 type - 1用户协议2隐私政策3社区规范
     *
     * @return int
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * 赋值 type - 1用户协议2隐私政策3社区规范
     * @param int $type type
     * @return static
     */ 
    public function setType($type)
    {
        $this->type = $type;
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

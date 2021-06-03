<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * officialmsg 基类
 * @Entity
 * @Table(name="officialmsg", id={"id"})
 * @DDL("CREATE TABLE `officialmsg` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(255) NOT NULL COMMENT '标题',
`content` longblob NOT NULL COMMENT '内容',
`img` varchar(255) NOT NULL COMMENT '封面图',
`add_time` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id
 * @property string $title 标题
 * @property string $content 内容
 * @property string $img 封面图
 * @property int $addTime
 */
abstract class OfficialmsgBase extends Model
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
     * 标题
     * title
     * @Column(name="title", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $title;

    /**
     * 获取 title - 标题
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 赋值 title - 标题
     * @param string $title title
     * @return static
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * 内容
     * content
     * @Column(name="content", type="longblob", length=0, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
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
     * 封面图
     * img
     * @Column(name="img", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $img;

    /**
     * 获取 img - 封面图
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * 赋值 img - 封面图
     * @param string $img img
     * @return static
     */
    public function setImg($img)
    {
        $this->img = $img;
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

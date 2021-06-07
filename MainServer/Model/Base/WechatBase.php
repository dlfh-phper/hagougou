<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * wechat 基类
 * @Entity
 * @Table(name="wechat", id={"id"})
 * @DDL("CREATE TABLE `wechat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL COMMENT '文字信息',
  `url` varchar(255) NOT NULL COMMENT '图片信息',
  `fabulous` int(11) NOT NULL COMMENT '点赞数量',
  `comment` int(11) NOT NULL COMMENT '评论数量',
  `add_time` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `label` varchar(255) NOT NULL COMMENT '标签',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property string $text 文字信息
 * @property string $url 图片信息
 * @property int $fabulous 点赞数量
 * @property int $comment 评论数量
 * @property int $addTime 
 * @property int $uid 
 * @property string $label 标签
 */
abstract class WechatBase extends Model
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
     * 文字信息
     * text
     * @Column(name="text", type="text", length=0, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $text;

    /**
     * 获取 text - 文字信息
     *
     * @return string
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * 赋值 text - 文字信息
     * @param string $text text
     * @return static
     */ 
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * 图片信息
     * url
     * @Column(name="url", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $url;

    /**
     * 获取 url - 图片信息
     *
     * @return string
     */ 
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * 赋值 url - 图片信息
     * @param string $url url
     * @return static
     */ 
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * 点赞数量
     * fabulous
     * @Column(name="fabulous", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $fabulous;

    /**
     * 获取 fabulous - 点赞数量
     *
     * @return int
     */ 
    public function getFabulous()
    {
        return $this->fabulous;
    }

    /**
     * 赋值 fabulous - 点赞数量
     * @param int $fabulous fabulous
     * @return static
     */ 
    public function setFabulous($fabulous)
    {
        $this->fabulous = $fabulous;
        return $this;
    }

    /**
     * 评论数量
     * comment
     * @Column(name="comment", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $comment;

    /**
     * 获取 comment - 评论数量
     *
     * @return int
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * 赋值 comment - 评论数量
     * @param int $comment comment
     * @return static
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;
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
     * 标签
     * label
     * @Column(name="label", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $label;

    /**
     * 获取 label - 标签
     *
     * @return string
     */ 
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * 赋值 label - 标签
     * @param string $label label
     * @return static
     */ 
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

}

<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * matchingmessage 基类
 * @Entity
 * @Table(name="matchingmessage", id={"id"})
 * @DDL("CREATE TABLE `matchingmessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senduid` int(11) NOT NULL COMMENT '发送人id',
  `receiveuid` int(11) NOT NULL COMMENT '接收人id',
  `content` varchar(255) NOT NULL COMMENT '聊天内容',
  `add_time` int(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property int $senduid 发送人id
 * @property int $receiveuid 接收人id
 * @property string $content 聊天内容
 * @property int $addTime 时间
 */
abstract class MatchingmessageBase extends Model
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
     * 发送人id
     * senduid
     * @Column(name="senduid", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $senduid;

    /**
     * 获取 senduid - 发送人id
     *
     * @return int
     */ 
    public function getSenduid()
    {
        return $this->senduid;
    }

    /**
     * 赋值 senduid - 发送人id
     * @param int $senduid senduid
     * @return static
     */ 
    public function setSenduid($senduid)
    {
        $this->senduid = $senduid;
        return $this;
    }

    /**
     * 接收人id
     * receiveuid
     * @Column(name="receiveuid", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $receiveuid;

    /**
     * 获取 receiveuid - 接收人id
     *
     * @return int
     */ 
    public function getReceiveuid()
    {
        return $this->receiveuid;
    }

    /**
     * 赋值 receiveuid - 接收人id
     * @param int $receiveuid receiveuid
     * @return static
     */ 
    public function setReceiveuid($receiveuid)
    {
        $this->receiveuid = $receiveuid;
        return $this;
    }

    /**
     * 聊天内容
     * content
     * @Column(name="content", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $content;

    /**
     * 获取 content - 聊天内容
     *
     * @return string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * 赋值 content - 聊天内容
     * @param string $content content
     * @return static
     */ 
    public function setContent($content)
    {
        $this->content = $content;
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

}

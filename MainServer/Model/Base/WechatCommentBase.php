<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * wechat_comment 基类
 * @Entity
 * @Table(name="wechat_comment", id={"comment_id"})
 * @DDL("CREATE TABLE `wechat_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL COMMENT '评论内容',
  `uid` int(11) NOT NULL COMMENT '评论人员id',
  `parent_id` int(11) DEFAULT NULL COMMENT '上一条评论id',
  `reply_id` int(11) DEFAULT NULL COMMENT '回复人id',
  `add_time` int(11) NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $commentId 
 * @property string $content 评论内容
 * @property int $uid 评论人员id
 * @property int $parentId 上一条评论id
 * @property int $replyId 回复人id
 * @property int $addTime 评论时间
 */
abstract class WechatCommentBase extends Model
{
    /**
     * comment_id
     * @Column(name="comment_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=true, primaryKeyIndex=0, isAutoIncrement=true)
     * @var int
     */
    protected $commentId;

    /**
     * 获取 commentId
     *
     * @return int
     */ 
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * 赋值 commentId
     * @param int $commentId comment_id
     * @return static
     */ 
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;
        return $this;
    }

    /**
     * 评论内容
     * content
     * @Column(name="content", type="text", length=0, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $content;

    /**
     * 获取 content - 评论内容
     *
     * @return string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * 赋值 content - 评论内容
     * @param string $content content
     * @return static
     */ 
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * 评论人员id
     * uid
     * @Column(name="uid", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $uid;

    /**
     * 获取 uid - 评论人员id
     *
     * @return int
     */ 
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 赋值 uid - 评论人员id
     * @param int $uid uid
     * @return static
     */ 
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 上一条评论id
     * parent_id
     * @Column(name="parent_id", type="int", length=11, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $parentId;

    /**
     * 获取 parentId - 上一条评论id
     *
     * @return int
     */ 
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * 赋值 parentId - 上一条评论id
     * @param int $parentId parent_id
     * @return static
     */ 
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        return $this;
    }

    /**
     * 回复人id
     * reply_id
     * @Column(name="reply_id", type="int", length=11, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $replyId;

    /**
     * 获取 replyId - 回复人id
     *
     * @return int
     */ 
    public function getReplyId()
    {
        return $this->replyId;
    }

    /**
     * 赋值 replyId - 回复人id
     * @param int $replyId reply_id
     * @return static
     */ 
    public function setReplyId($replyId)
    {
        $this->replyId = $replyId;
        return $this;
    }

    /**
     * 评论时间
     * add_time
     * @Column(name="add_time", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $addTime;

    /**
     * 获取 addTime - 评论时间
     *
     * @return int
     */ 
    public function getAddTime()
    {
        return $this->addTime;
    }

    /**
     * 赋值 addTime - 评论时间
     * @param int $addTime add_time
     * @return static
     */ 
    public function setAddTime($addTime)
    {
        $this->addTime = $addTime;
        return $this;
    }

}

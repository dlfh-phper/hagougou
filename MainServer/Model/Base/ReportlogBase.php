<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * reportlog 基类
 * @Entity
 * @Table(name="reportlog", id={"id"})
 * @DDL("CREATE TABLE `reportlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '举报人id',
  `report_id` int(11) NOT NULL COMMENT '被举报人id',
  `nickname` varchar(255) NOT NULL COMMENT '被举报人昵称',
  `url` text NOT NULL,
  `content` text NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1已举报 2处理中 3处理完毕',
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property int $uid 举报人id
 * @property int $reportId 被举报人id
 * @property string $nickname 被举报人昵称
 * @property string $url 
 * @property string $content 
 * @property int $type 
 * @property int $status 1已举报 2处理中 3处理完毕
 * @property int $addTime 
 */
abstract class ReportlogBase extends Model
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
     * 举报人id
     * uid
     * @Column(name="uid", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $uid;

    /**
     * 获取 uid - 举报人id
     *
     * @return int
     */ 
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * 赋值 uid - 举报人id
     * @param int $uid uid
     * @return static
     */ 
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * 被举报人id
     * report_id
     * @Column(name="report_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $reportId;

    /**
     * 获取 reportId - 被举报人id
     *
     * @return int
     */ 
    public function getReportId()
    {
        return $this->reportId;
    }

    /**
     * 赋值 reportId - 被举报人id
     * @param int $reportId report_id
     * @return static
     */ 
    public function setReportId($reportId)
    {
        $this->reportId = $reportId;
        return $this;
    }

    /**
     * 被举报人昵称
     * nickname
     * @Column(name="nickname", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $nickname;

    /**
     * 获取 nickname - 被举报人昵称
     *
     * @return string
     */ 
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * 赋值 nickname - 被举报人昵称
     * @param string $nickname nickname
     * @return static
     */ 
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * url
     * @Column(name="url", type="text", length=0, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $url;

    /**
     * 获取 url
     *
     * @return string
     */ 
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * 赋值 url
     * @param string $url url
     * @return static
     */ 
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * content
     * @Column(name="content", type="text", length=0, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $content;

    /**
     * 获取 content
     *
     * @return string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * 赋值 content
     * @param string $content content
     * @return static
     */ 
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * type
     * @Column(name="type", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $type;

    /**
     * 获取 type
     *
     * @return int
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * 赋值 type
     * @param int $type type
     * @return static
     */ 
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * 1已举报 2处理中 3处理完毕
     * status
     * @Column(name="status", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $status;

    /**
     * 获取 status - 1已举报 2处理中 3处理完毕
     *
     * @return int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 赋值 status - 1已举报 2处理中 3处理完毕
     * @param int $status status
     * @return static
     */ 
    public function setStatus($status)
    {
        $this->status = $status;
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

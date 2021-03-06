<?php
namespace ImiApp\MainServer\Model\Base;

use Imi\Model\Model as Model;
use Imi\Model\Annotation\DDL;
use Imi\Model\Annotation\Table;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;

/**
 * room 基类
 * @Entity
 * @Table(name="room", id={"id"})
 * @DDL("CREATE TABLE `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomnumber` int(11) NOT NULL COMMENT '房间号',
  `start_time` int(11) DEFAULT NULL COMMENT '开始时间',
  `stop_time` int(11) DEFAULT NULL COMMENT '结束时间',
  `user_id` int(11) NOT NULL COMMENT '开播人',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `giftvalue` int(11) DEFAULT '0' COMMENT '房间热度',
  `isStop` int(11) DEFAULT '0' COMMENT '0关闭 1开始',
  `countvalue` int(11) NOT NULL DEFAULT '0' COMMENT '总热度',
  `cover` varchar(255) NOT NULL COMMENT '封面图',
  `label` varchar(255) DEFAULT NULL COMMENT '标签',
  `introduce` varchar(255) NOT NULL COMMENT '简介',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `eception` varchar(255) NOT NULL COMMENT '接待语',
  `welcome` varchar(255) NOT NULL COMMENT '欢迎语',
  `blacklist` varchar(255) DEFAULT NULL COMMENT '黑名单列表',
  `isPush` int(11) NOT NULL DEFAULT '0' COMMENT '0不推送 2推送',
  `bulletin` text COMMENT '公告',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4")
 * @property int $id 
 * @property int $roomnumber 房间号
 * @property int $startTime 开始时间
 * @property int $stopTime 结束时间
 * @property int $userId 开播人
 * @property string $title 标题
 * @property int $giftvalue 房间热度
 * @property int $isStop 0关闭 1开始
 * @property int $countvalue 总热度
 * @property string $cover 封面图
 * @property string $label 标签
 * @property string $introduce 简介
 * @property string $password 密码
 * @property string $eception 接待语
 * @property string $welcome 欢迎语
 * @property string $blacklist 黑名单列表
 * @property int $isPush 0不推送 2推送
 * @property string $bulletin 公告
 */
abstract class RoomBase extends Model
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
     * 房间号
     * roomnumber
     * @Column(name="roomnumber", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $roomnumber;

    /**
     * 获取 roomnumber - 房间号
     *
     * @return int
     */ 
    public function getRoomnumber()
    {
        return $this->roomnumber;
    }

    /**
     * 赋值 roomnumber - 房间号
     * @param int $roomnumber roomnumber
     * @return static
     */ 
    public function setRoomnumber($roomnumber)
    {
        $this->roomnumber = $roomnumber;
        return $this;
    }

    /**
     * 开始时间
     * start_time
     * @Column(name="start_time", type="int", length=11, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $startTime;

    /**
     * 获取 startTime - 开始时间
     *
     * @return int
     */ 
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * 赋值 startTime - 开始时间
     * @param int $startTime start_time
     * @return static
     */ 
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * 结束时间
     * stop_time
     * @Column(name="stop_time", type="int", length=11, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $stopTime;

    /**
     * 获取 stopTime - 结束时间
     *
     * @return int
     */ 
    public function getStopTime()
    {
        return $this->stopTime;
    }

    /**
     * 赋值 stopTime - 结束时间
     * @param int $stopTime stop_time
     * @return static
     */ 
    public function setStopTime($stopTime)
    {
        $this->stopTime = $stopTime;
        return $this;
    }

    /**
     * 开播人
     * user_id
     * @Column(name="user_id", type="int", length=11, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $userId;

    /**
     * 获取 userId - 开播人
     *
     * @return int
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * 赋值 userId - 开播人
     * @param int $userId user_id
     * @return static
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;
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
     * 房间热度
     * giftvalue
     * @Column(name="giftvalue", type="int", length=11, accuracy=0, nullable=true, default="0", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $giftvalue;

    /**
     * 获取 giftvalue - 房间热度
     *
     * @return int
     */ 
    public function getGiftvalue()
    {
        return $this->giftvalue;
    }

    /**
     * 赋值 giftvalue - 房间热度
     * @param int $giftvalue giftvalue
     * @return static
     */ 
    public function setGiftvalue($giftvalue)
    {
        $this->giftvalue = $giftvalue;
        return $this;
    }

    /**
     * 0关闭 1开始
     * isStop
     * @Column(name="isStop", type="int", length=11, accuracy=0, nullable=true, default="0", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $isStop;

    /**
     * 获取 isStop - 0关闭 1开始
     *
     * @return int
     */ 
    public function getIsStop()
    {
        return $this->isStop;
    }

    /**
     * 赋值 isStop - 0关闭 1开始
     * @param int $isStop isStop
     * @return static
     */ 
    public function setIsStop($isStop)
    {
        $this->isStop = $isStop;
        return $this;
    }

    /**
     * 总热度
     * countvalue
     * @Column(name="countvalue", type="int", length=11, accuracy=0, nullable=false, default="0", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $countvalue;

    /**
     * 获取 countvalue - 总热度
     *
     * @return int
     */ 
    public function getCountvalue()
    {
        return $this->countvalue;
    }

    /**
     * 赋值 countvalue - 总热度
     * @param int $countvalue countvalue
     * @return static
     */ 
    public function setCountvalue($countvalue)
    {
        $this->countvalue = $countvalue;
        return $this;
    }

    /**
     * 封面图
     * cover
     * @Column(name="cover", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $cover;

    /**
     * 获取 cover - 封面图
     *
     * @return string
     */ 
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * 赋值 cover - 封面图
     * @param string $cover cover
     * @return static
     */ 
    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * 标签
     * label
     * @Column(name="label", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
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

    /**
     * 简介
     * introduce
     * @Column(name="introduce", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $introduce;

    /**
     * 获取 introduce - 简介
     *
     * @return string
     */ 
    public function getIntroduce()
    {
        return $this->introduce;
    }

    /**
     * 赋值 introduce - 简介
     * @param string $introduce introduce
     * @return static
     */ 
    public function setIntroduce($introduce)
    {
        $this->introduce = $introduce;
        return $this;
    }

    /**
     * 密码
     * password
     * @Column(name="password", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $password;

    /**
     * 获取 password - 密码
     *
     * @return string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * 赋值 password - 密码
     * @param string $password password
     * @return static
     */ 
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * 接待语
     * eception
     * @Column(name="eception", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $eception;

    /**
     * 获取 eception - 接待语
     *
     * @return string
     */ 
    public function getEception()
    {
        return $this->eception;
    }

    /**
     * 赋值 eception - 接待语
     * @param string $eception eception
     * @return static
     */ 
    public function setEception($eception)
    {
        $this->eception = $eception;
        return $this;
    }

    /**
     * 欢迎语
     * welcome
     * @Column(name="welcome", type="varchar", length=255, accuracy=0, nullable=false, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $welcome;

    /**
     * 获取 welcome - 欢迎语
     *
     * @return string
     */ 
    public function getWelcome()
    {
        return $this->welcome;
    }

    /**
     * 赋值 welcome - 欢迎语
     * @param string $welcome welcome
     * @return static
     */ 
    public function setWelcome($welcome)
    {
        $this->welcome = $welcome;
        return $this;
    }

    /**
     * 黑名单列表
     * blacklist
     * @Column(name="blacklist", type="varchar", length=255, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $blacklist;

    /**
     * 获取 blacklist - 黑名单列表
     *
     * @return string
     */ 
    public function getBlacklist()
    {
        return $this->blacklist;
    }

    /**
     * 赋值 blacklist - 黑名单列表
     * @param string $blacklist blacklist
     * @return static
     */ 
    public function setBlacklist($blacklist)
    {
        $this->blacklist = $blacklist;
        return $this;
    }

    /**
     * 0不推送 2推送
     * isPush
     * @Column(name="isPush", type="int", length=11, accuracy=0, nullable=false, default="0", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var int
     */
    protected $isPush;

    /**
     * 获取 isPush - 0不推送 2推送
     *
     * @return int
     */ 
    public function getIsPush()
    {
        return $this->isPush;
    }

    /**
     * 赋值 isPush - 0不推送 2推送
     * @param int $isPush isPush
     * @return static
     */ 
    public function setIsPush($isPush)
    {
        $this->isPush = $isPush;
        return $this;
    }

    /**
     * 公告
     * bulletin
     * @Column(name="bulletin", type="text", length=0, accuracy=0, nullable=true, default="", isPrimaryKey=false, primaryKeyIndex=-1, isAutoIncrement=false)
     * @var string
     */
    protected $bulletin;

    /**
     * 获取 bulletin - 公告
     *
     * @return string
     */ 
    public function getBulletin()
    {
        return $this->bulletin;
    }

    /**
     * 赋值 bulletin - 公告
     * @param string $bulletin bulletin
     * @return static
     */ 
    public function setBulletin($bulletin)
    {
        $this->bulletin = $bulletin;
        return $this;
    }

}

<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Model\Spotzan;
use ImiApp\MainServer\Model\User;
use ImiApp\MainServer\Model\Wechat;
use Imi\Aop\Annotation\Inject;
use Imi\Db\Annotation\Transaction;
use ImiApp\MainServer\Model\WechatComment;

/**
 * Class DynamicService
 * @package ImiApp\MainServer\Service
 * @Bean("DynamicService")
 */
class DynamicService
{
    /**
     * @Inject("UserSessionService");
     * @var
     */
    protected $UserSessionService;

    /**
     * Date: 2021/5/24
     * Time: 16:40
     * @param string $text
     * @param string $url
     * 发布动态
     */
    public function setWechat(string $text,string $url,int $uid)
    {
        $info=Wechat::newInstance();
        $info->setText($text);
        $info->setUrl($url);
        $info->setUid($uid);
        $info->setFabulous(0);
        $info->setComment(0);
        $info->setAddTime(time());
        $info->insert();
    }

    /**
     * Date: 2021/5/25
     * Time: 9:54
     * Transaction //开启注解事务
     * @param int $uid
     * @param int $wid
     */
    public function spotzan(int $uid,int $wid)
    {

        $result=Spotzan::find(
            ['uid'=>$uid,'w_id'=>$wid]
        );

        //数据存在证明这个人点过赞，就删除记录
        if(!$result){
            $info=Spotzan::newInstance();
            $info->setUid($uid);
            $info->setWId($wid);
            $info->setAddTime(time());
            $info->insert();
            Wechat::query()->where('id','=',$wid)->setFieldInc('fabulous','1')->update();
        }else{
            Wechat::query()->where('id','=',$wid)->setFieldDec('fabulous','1')->update();
            $result->delete();
        }
    }

    /**
     * Date: 2021/5/25
     * Time: 10:28
     * Transaction
     * @param string $content
     * @param int $uid
     * @param int $w_id
     * @param int $parent_id
     * @param int $reply_id
     */
    public function setWechatComment(string $content,int $wid,int $parent_id,int $reply_id,int $uid)
    {
        $info=WechatComment::newInstance();
        $info->setUid($uid);
        $info->setContent($content);
        $info->setReplyId($reply_id);
        $info->setWId($wid);
        $info->setParentId($parent_id);
        $info->setAddTime(time());
        $info->insert();
        Wechat::query()->where('id','=',$wid)->setFieldInc('comment','1')->update();
    }

    /**
     * Date: 2021/5/25
     * Time: 10:48
     * Transaction
     * @param int $wid
     * @param int $comment_id
     * @param int $uid
     * 删除评论同时评论数量减一
     */
    public function deleteComment(int $wid,int $comment_id,int $uid)
    {
        $info=WechatComment::find(
            [
                'w_id' => $wid,
                'comment_id' => $comment_id,
                'uid' => $uid
            ]);
        $info->delete();
        Wechat::query()->where('id','=',$wid)->setFieldDec('comment','1')->update();
    }

    /**
     * Date: 2021/5/25
     * Time: 11:20
     * @param int $wid
     * @param int $uid
     * 获取动态的点赞和评论
     */
    public function getWechatinfo(int $wid)
    {
        $info=Wechat::find([
            'id'=>$wid,
        ]);
        $info['fabulous']=$this->spotzanniCkname($wid);
        $info['comment']=$this->comment($wid);
        return $info;
    }

    /**
     * Date: 2021/5/25
     * Time: 11:21
     * @param int $wid
     * @return mixed
     * 获取点赞人的头像
     */
    public function spotzanniCkname(int $wid)
    {
        $info=Spotzan::query()->where('w_id','=',$wid)->select()->getArray();
        foreach ($info as $key=>$value){
            $user=User::find($value['uid']);
            $info[$key]['nickname']=$user['nickname'] ?? $user['wxname'] ?? $user['qqname'];
        }
        return $info['nickname'];
    }

    /**
     * Date: 2021/5/25
     * Time: 11:22
     * @param int $wid
     * @return array
     * 获取评论和被回复人的头像
     */
    public function comment(int $wid)
    {
        $info=WechatComment::query()->where('w_id','=',$wid)->select()->getArray();
        foreach ($info as $key=>$value){
            if($value['reply_id']){
                $user=User::find($value['reply_id']);
                $info[$key]['reply_id']=$user['nickname'] ?? $user['wxname'] ?? $user['qqname'];
            }
        }
        return $info;
    }

    /**
     * Date: 2021/5/25
     * Time: 11:31
     * @param int $page
     * @param int $page_size
     * @return array
     * 广场动态列表
     */
    public function getWechatList(int $page,int $page_size)
    {
        $list=Wechat::query()->page(($page-1)*$page_size,$page_size)->select()->getArray();
        foreach ($list as $key=>$value)
        {
            $list[$key]=$this->getWechatinfo($value['id']);
        }
        $count=Wechat::query()->count('id');
        $result['list']=$list;
        $result['count']=$count;
        return $result;
    }

    /**
     * Date: 2021/5/25
     * Time: 11:52
     * Transaction
     * @param int $wid
     * @param int $uid
     */
    public function deleteWechat(int $wid,int $uid)
    {
        //删除动态
        $info=Wechat::find([
            'id'=>$wid,
            'uid'=>$uid
        ]);
        $info->delete();
        //删除点赞信息
        Spotzan::query()->where('w_id','=',$wid)->where('uid','=',$uid)->delete();
        //删除评论信息
        WechatComment  ::query()->where('w_id','=',$wid)->where('uid','=',$uid)->delete();

    }
}
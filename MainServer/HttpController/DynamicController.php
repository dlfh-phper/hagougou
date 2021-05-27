<?php


namespace ImiApp\MainServer\HttpController;


use Imi\Controller\SingletonHttpController;
use Imi\Server\Route\Annotation\Controller;
use Imi\HttpValidate\Annotation\HttpValidation;
use Imi\Validate\Annotation\Regex;
use Imi\Validate\Annotation\Text;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Aop\Annotation\Inject;
use Imi\Server\Session\Session;
use Imi\Validate\Annotation\Integer;
use Imi\Validate\Annotation\Required;
/**
 * Class DynamicController
 * @package ImiApp\MainServer\HttpController
 * @Controller("/Dynamic/")
 */
class DynamicController extends SingletonHttpController
{

    /**
     * @Inject("DynamicService")
     * @var
     */
    protected $DynamicService;
    /**
     * @Inject("UserSessionService")
     */
    protected $UserSessionService;
    /**
     * @var
     * @Inject("RedisService");
     */
    protected $RedisService;
    /**
     * Date: 2021/5/24
     * Time: 16:42
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="text", message="文字内容不能为空")
     * @Text(name="text",max=700, message="文字内容最多700字,包含空格字符")
     * @param string $text
     * @param string $url
     * 发布动态，文字最多700个，图片最多九张
     */
    public function setSquareDynamic(string $text,string $url)
    {
        return [
            'data' => $this->DynamicService->setWechat($text,$url,Session::get('user_id'))
        ];
    }

    /**
     * Date: 2021/5/25
     * Time: 10:38
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="wid", message="wid不能为空")
     * @param int $wid
     * @return array
     * 点赞，再点一次取消点赞
     */
    public function setSpotzan(int $wid)
    {
        return [
            'data' => $this->DynamicService->spotzan(Session::get('user_id'),$wid)
        ];
    }

    /**
     * Date: 2021/5/25
     * Time: 10:43
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="content", message="评论不能为空")
     * @Required(name="wid", message="wid不能为空")
     * @Text(name="content",max=140, message="评论限制140字,包含空格字符")
     * @param string $content
     * @param int $wid
     * @param int $parent_id
     * @param int $reply_id
     * @return array
     * 评论，回复评论
     */
    public function setComment(string $content,int $wid,int $parent_id,int $reply_id)
    {
        return [
            'data'=>$this->DynamicService->setWechatComment($content,$wid,$parent_id,$reply_id,Session::get('user_id'))
        ];
    }

    /**
     * Date: 2021/5/25
     * Time: 10:45
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="comment_id", message="comment_id不能为空")
     * @Required(name="wid", message="wid不能为空")
     */
    public function deleteComment(int $wid,int $comment_id)
    {
        $this->DynamicService->deleteComment($wid,$comment_id,Session::get('user_id'));
    }

    /**
     * Date: 2021/5/25
     * Time: 11:23
     * @Action
     * @Route(method="POST")
     * @Required(name="wid", message="wid不能为空")
     * @param int $wid
     */
    public function getWechatinfo(int $wid)
    {
        return [
            'data' =>$this->DynamicService->getWechatinfo($wid)
        ];
    }

    /**
     * Date: 2021/5/25
     * Time: 11:25
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="page", default="1")
     * @Required(name="page_size", default="10")
     */
    public function getWechatList(int $page,int $page_size)
    {
        return [
            'data' =>$this->DynamicService->getWechatList($page,$page_size)
        ];
    }

    /**
     * Date: 2021/5/25
     * Time: 15:05
     * @Action
     * @Route(method="POST")
     * @param int $wid
     */
    public function delete(int $wid)
    {
        $this->DynamicService->deleteWechat($wid,Session::get('user_id'));
    }

    /**
     * Date: 2021/5/25
     * Time: 16:05
     * @Action
     * @Route(method="POST")
     */
    public function Confession(array $data)
    {
        $this->RedisService->setRedislpush('DynamicConfession',$data);
    }

    /**
     * Date: 2021/5/25
     * Time: 16:17
     * @Action
     * @Route(method="POST")
     * @return array
     */
    public function getConfessionMessage()
    {
        return [
            'data'=>$this->RedisService->getRedislpushMessage('DynamicConfession')
        ];
    }
}
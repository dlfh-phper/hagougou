<?php


namespace ImiApp\MainServer\HttpController;

use Imi\Controller\SingletonHttpController;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;
use Imi\HttpValidate\Annotation\HttpValidation;
use Imi\Validate\Annotation\Integer;
use Imi\Validate\Annotation\Required;
use Imi\Validate\Annotation\Regex;
use Imi\Aop\Annotation\Inject;
use Imi\Server\Session\Session;
use Imi\Config;

/**
 * Class MessageController
 * @package ImiApp\MainServer\HttpController
 * @Controller("/Message/");
 */
class MessageController extends SingletonHttpController
{
    /**
     * @var
     * @Inject("OfficialmsgService");
     */
    protected $OfficialmsgService;
    /**
     * @var
     * @Inject("DynamicService")
     */
    protected $DynamicService;
    /**
     * Date: 2021/6/4
     * Time: 15:06
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="page", default="1")
     * @Required(name="page_size", default="10")
     * @param int $page
     * @param int $page_size
     * @return array
     */
    public function getOfficialmsg(int $page,int $page_size)
    {
        return [
            'data' =>$this->OfficialmsgService->getMsgList($page,$page_size)
        ];
    }

    /**
     * Date: 2021/6/4
     * Time: 15:08
     * @Action
     * @Route(method="POST")
     * @param int $id
     * @return array
     */
    public function getOfficialmsginfo(int $id)
    {
        return [
            'data' =>$this->OfficialmsgService->getMsgInfo($id)
        ];
    }

    /**
     * Date: 2021/6/4
     * Time: 15:24
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="page", default="1")
     * @Required(name="page_size", default="10")
     * 点赞动态消息
     */
    public function getDynamicMsg(int $page,int $page_size)
    {
        return [
            'data' => $this->DynamicService->getSpotzanDynamic($page,$page_size,Session::get('user_id'))
        ];
    }

    /**
     * Date: 2021/6/4
     * Time: 16:41
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="page", default="1")
     * @Required(name="page_size", default="10")
     * @param int $page
     * @param int $page_size
     * @return array
     * 评论动态消息
     */
    public function getCommentDynamic(int $page,int $page_size)
    {
        return [
            'data' => $this->DynamicService->getCommentDynamic($page,$page_size,Session::get('user_id'))
        ];
    }
}
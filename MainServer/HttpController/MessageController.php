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
     */
    public function getDynamicMsg(int $page,int $page_size)
    {

    }
}
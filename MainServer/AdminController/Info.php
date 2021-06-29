<?php


namespace ImiApp\MainServer\AdminController;

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
use Imi\Server\Route\Annotation\Middleware;

/**
 * Class Info
 * @package ImiApp\MainServer\AdminController
 * @Controller("/Info/")
 */
class Info extends SingletonHttpController
{
    /**
     * @var
     * @Inject("RportFedbackService");
     */
    protected $RportFedbackService;
    /**
     * Date: 2021/6/29
     * Time: 16:19
     * @Action
     * @Route(method="POST")
     * @param int $status
     */
    public function getRportFedback(int $status,int $page,int $page_size)
    {
        return [
            'data' => $this->RportFedbackService->getReportList($status,$page,$page_size)
        ];
    }
}
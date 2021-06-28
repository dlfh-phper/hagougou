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
 * Class Recharge
 * @package ImiApp\MainServer\AdminController
 * @Controller("/Recharge/")
 */
class Recharge extends SingletonHttpController
{

    /**
     * @var
     * @Inject("PayService");
     */
    protected $payService;

    /**
     * Date: 2021/6/28
     * Time: 15:48
     * @Action
     * @Route(method="POST")
     * @param int $page
     * @param int $page_size
     * @return array
     */
    public function getRechargeLog(int $page,int $page_size)
    {
        return [
            'data' => $this->payService->getRechargeLog($page,$page_size)
        ];
    }
}
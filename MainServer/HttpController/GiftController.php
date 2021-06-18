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
 * Class GiftController
 * @package ImiApp\MainServer\HttpController
 * @Controller("/GiftController/")
 */
class GiftController
{
    /**
     * @var
     * @Inject("GiftService")
     */
    protected $GiftService;

    /***
     * Date: 2021/6/18
     * Time: 10:05
     * @Action
     * @Route(method="POST")
     * @param int $shop_id
     * 购买礼物
     */
    public function PurchaseGift(int $shop_id)
    {
        $this->GiftService->PurchaseGift($shop_id,Session::get('user_id'));
    }
}
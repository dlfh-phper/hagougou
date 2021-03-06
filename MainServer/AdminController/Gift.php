<?php


namespace ImiApp\MainServer\AdminController;


use Imi\Controller\SingletonHttpController;
use Imi\Server\Route\Annotation\Controller;
use Imi\HttpValidate\Annotation\HttpValidation;
use Imi\Validate\Annotation\Regex;
use Imi\Validate\Annotation\Text;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Middleware;
use Imi\Aop\Annotation\Inject;
use Imi\Server\Session\Session;
use Imi\Validate\Annotation\Integer;
use Imi\Validate\Annotation\Required;

/**
 * Class Gift
 * @package ImiApp\MainServer\AdminController
 * @Controller("/Gift/");
 */
class Gift extends SingletonHttpController
{
    /**
     * @var
     * @Inject("GiftService")
     */
    protected $GiftService;
    /**
     * Date: 2021/6/2
     * Time: 16:18
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="page", default="1")
     * @Required(name="page_size", default="10")
     */
    public function getGift(int $page,int $page_size)
    {
        return [
            'data' => $this->GiftService->getGift($page,$page_size)
        ];
    }

    /**
     * Date: 2021/6/2
     * Time: 16:26
     * @Action
     * @Route(method="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @HttpValidation
     * @Required(name="url", message="礼物不能为空")
     * @Required(name="price", message="价格不能为空")
     * @Required(name="type", message="类型不能为空")
     */
    public function setGift(string $url,int $price,int $type,string $name,string $cover)
    {
        $this->GiftService->setGift($url,$price,$type,$name,$cover);
    }

    /**
     * Date: 2021/6/2
     * Time: 16:38
     * @Action
     * @Route(method="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     */
    public function deleteGift(string $id)
    {
        $this->GiftService->deleteGift($id);
    }

    /**
     * Date: 2021/6/21
     * Time: 14:50
     * @Action
     * @Route(method="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @Required(name="url", message="头像框不能为空")
     * @Required(name="price", message="价格不能为空")
     * @param string $url
     * @param int $price
     */
    public function setHeadFrame(string $url, int $price)
    {
        $this->GiftService->setHeadFrame($url,$price);
    }
}
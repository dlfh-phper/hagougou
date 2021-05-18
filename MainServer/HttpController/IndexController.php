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
/**
 * @Controller("/Index/")
 */
class IndexController extends SingletonHttpController
{
    /**
     * @Inject("BannerService")
     * @var
     */
    protected $BannerService;
    /**
     * @Action
     * @Route(method="POST")
     * @return void
     */
    public function banner()
    {
        $info=$this->BannerService->getBanner('首页');
        return [
            'data'=>$info
        ];
    }

    /**
     * @Action
     *
     * @return void
     */
    public function api()
    {
        return [
            'data'  =>  'api',
        ];
    }

}

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
/**
 * @Controller
 */
class IndexController extends SingletonHttpController
{
    /**
     * @Action
     * @Route("/")
     *
     * @return void
     */
    public function login()
    {
        return [
            'data'  =>  'indexssss',
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

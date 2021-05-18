<?php
namespace ImiApp\MainServer\HttpController;

use Imi\Controller\HttpController;
use Imi\Controller\SingletonHttpController;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;

/**
 * @Controller("/")
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

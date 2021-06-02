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
 * Class MatchingController
 * @package ImiApp\MainServer\HttpController
 * @Controller("/Matching/")
 */
class MatchingController extends SingletonHttpController
{
    /**
     * @Inject("UserService");
     * @var
     */
    protected $UserService;
    /**
     * Date: 2021/6/1
     * Time: 15:46
     * @Action
     * @Route(method="POST")
     */
    public function getRandMatchingUser()
    {
        return [
            'data' =>$this->UserService->getRandUserinfo(1),
        ];
    }
}
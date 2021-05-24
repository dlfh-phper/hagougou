<?php


namespace ImiApp\MainServer\HttpController;


use Imi\Controller\SingletonHttpController;
use Imi\Aop\Annotation\Inject;
use Imi\Validate\Annotation\Regex;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;

/**
 * Class ApiController
 * @package ImiApp\MainServer\HttpController
 * @Controller("/Api/")
 */
class ApiController extends SingletonHttpController
{
    /**
     * @Inject("ApiService");
     */
    protected $ApiService;
    /**
     * Date: 2021/5/20
     * Time: 16:43
     * @Action
     * @Route(method="POST")
     */
    public function upload()
    {
        $file=$this->request->getUploadedFiles();
        $this->ApiService->Upload($file['name'],$file['tmp_name']);
    }
}
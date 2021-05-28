<?php


namespace ImiApp\MainServer\HttpController;


use Imi\Controller\SingletonHttpController;
use Imi\Aop\Annotation\Inject;
use Imi\Validate\Annotation\Regex;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;
use Imi\Server\Session\Session;

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
     * @Inject("UserSessionService");
     * @var
     */
    protected $UserSessionService;
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

    /**
     * Date: 2021/5/28
     * Time: 10:43
     * @Action
     * @Route(method="POST")
     * @return array
     */
    public function sethhh($id)
    {
        Session::set('id',$id);
        return [
            'data'=>Session::getID(),
        ];
    }

    /**
     * Date: 2021/5/28
     * Time: 10:55
     * @Action
     * @Route(method="POST")
     */
    public function getid()
    {
        return [
            'data'=>Session::get('user_id'),
        ];
    }
}
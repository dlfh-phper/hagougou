<?php


namespace ImiApp\MainServer\HttpController;


use Imi\Controller\SingletonHttpController;
use Imi\Aop\Annotation\Inject;
use Imi\Validate\Annotation\Regex;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;
use Imi\Server\Session\Session;
use Imi\Server\Http\Message\UploadedFile;

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
        $request = \Imi\RequestContext::get('request')->getUploadedFiles();
        $file=$request['file'];
        return  [
            'data'=>$this->ApiService->Upload($file->getClientFilename(),$file->getTmpFileName()),
        ];

    }

    /**
     * Date: 2021/6/8
     * Time: 15:12
     * @Action
     * @Route(method="POST")
     * @param string $phone
     * @return array
     */
    public function Sms(string $phone)
    {
        return [
            'data' => $this->ApiService->sendSms($phone,'2'),
        ];
    }
}
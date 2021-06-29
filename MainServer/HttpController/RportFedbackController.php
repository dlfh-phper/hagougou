<?php


namespace ImiApp\MainServer\HttpController;

use Imi\Controller\SingletonHttpController;
use Imi\Listener\Init;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;
use Imi\HttpValidate\Annotation\HttpValidation;
use Imi\Server\Session\Session;
use Imi\Validate\Annotation\Integer;
use Imi\Validate\Annotation\Required;
use Imi\Validate\Annotation\Regex;
use Imi\Aop\Annotation\Inject;

/**
 * Class RportFedbackController
 * @package ImiApp\MainServer\HttpController
 * @Controller("/RportFedback/");
 */
class RportFedbackController extends SingletonHttpController
{
    /**
     * @var
     * @Inject("RportFedbackService")
     */
    protected $RportFedbackService;

    /**
     * Date: 2021/6/28
     * Time: 16:29
     * @Action
     * @Route(method="POST")
     * @param int $report_id
     * @param string $nickname
     * @param string $url
     * @param string $content
     * @param int $type
     */
    public function ReportHarmfulInfo(int $report_id,string $nickname,string $url,string $content,int $type)
    {
        $this->RportFedbackService->ReportHarmfulInfo($report_id,$nickname,$url,$content,$type,Session::get('user_id'));
    }

    /**
     * Date: 2021/6/29
     * Time: 16:16
     * @Action
     * @Route(method="POST")
     * @param string $content
     */
    public function AppFedback(string $content)
    {
        $this->RportFedbackService->AppFedback($content,Session::get('user_id'));
    }
}
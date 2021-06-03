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
 * Class Officialmsg
 * @package ImiApp\MainServer\AdminController
 * @Controller("/Officialmsg/")
 */
class Officialmsg extends SingletonHttpController
{
    /**
     * @var
     * @Inject("OfficialmsgService")
     */
    protected $OfficialmsgService;

    /**
     * Date: 2021/6/3
     * Time: 16:33
     * @Action
     * @Route(method="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @HttpValidation
     * @Required(name="title", message="标题不能为空")
     * @Required(name="content", message="内容不能为空")
     * @Required(name="img", message="封面图不能为空")
     * @Required(name="previewcontent", message="预览内容不能为空")
     * @param string $title
     * @param string $content
     * @param string $img
     * @param string $previewcontent
     * @param int $id
     */
    public function setMsg(string $title,string $content,string $img,string $previewcontent,int $id)
    {
        $this->OfficialmsgService->setMsg($title,$content,$img,$previewcontent,$id);
    }
}
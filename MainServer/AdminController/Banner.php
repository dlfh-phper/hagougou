<?php


namespace ImiApp\MainServer\AdminController;
use Imi\Controller\SingletonHttpController;
use Imi\Server\Route\Annotation\Controller;
use Imi\HttpValidate\Annotation\HttpValidation;
use Imi\Validate\Annotation\Regex;
use Imi\Validate\Annotation\Text;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Aop\Annotation\Inject;
use Imi\Server\Session\Session;
use Imi\Validate\Annotation\Integer;
use Imi\Validate\Annotation\Required;
use Imi\Server\Route\Annotation\Middleware;
/**
 * Class Banner
 * @package ImiApp\MainServer\AdminController
 * @Controller("/Banner/")
 */
class Banner extends SingletonHttpController
{
    /**
     * @Inject("BannerService");
     * @var
     */
    protected $BannerService;
    /**
     * Date: 2021/5/31
     * Time: 14:31
     * @Action
     * @Route(methon="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @HttpValidation
     * @Required(name="content", message="图片信息不能为空")
     * @Required(name="position", message="位置信息不能为空")
     * @param string $content
     * @param string $position
     */
    public function setBanner(string $content,string $position)
    {
         $this->BannerService->setBanner($content,$position);
    }

    /**
     * Date: 2021/5/31
     * Time: 14:48
     * @Action
     * @Route(methon="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     */
    public function deleteBanner(string $id)
    {
        $this->BannerService->deleteBanner($id);
    }

    /**
     * Date: 2021/5/31
     * Time: 14:50
     * @Action
     * @Route(methon="POST")
     */
    public function getBannerList()
    {
        return [
            'data' =>$this->BannerService->getBannerList(),
        ];
    }
}
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
     * @Inject("RoomService")
     */
    protected $RoomService;
    /**
     * @Inject("UserService")
     */
    protected $UserService;
    /**
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="position", message="手机号不能为空")
     * @return void
     * 轮播图
     */
    public function banner(string $position)
    {
        $info=$this->BannerService->getBanner($position);
        return [
            'data'=>$info
        ];
    }

    /**
     * Date: 2021/5/19
     * Time: 10:38
     * @Action
     * @Route(method="POST")
     * @return string[]
     * 首页房间列表
     */
    public function indexRoom()
    {
         return [
           'data'=> $this->RoomService->indexRoom()
         ];

    }

    /**
     * Date: 2021/5/19
     * Time: 11:06
     * @Action
     * @Route(method="POST")
     * @return array
     */
    public function getIndexRandUser()
    {
        return [
            'data' =>$this->UserService->getRandUserinfo()
        ];
    }
}

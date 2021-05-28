<?php
namespace ImiApp\MainServer\HttpController;


use Imi\Controller\SingletonHttpController;
use Imi\JWT\Facade\JWT;
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
     * @Inject("RedisService")
     */
    protected $RedisService;
    /**
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="position", message="位置信息不能为空")
     * @return void
     * 轮播图
     */
    public function banner(string $position)
    {
        $info=$this->BannerService->getBanner($position);
//        $info=$position ?? '6';
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
           'data'=> $this->RoomService->indexRoom(),
//           'data'=> Session::get('user_id')
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

    /**
     * Date: 2021/5/20
     * Time: 10:13
     * @Action
     * @Route(method="POST")
     */
    public function SendindexMessage(string $data)
    {
        $this->RedisService->setRedislpush('indexbroadcast',$data);
    }

    /**
     * Date: 2021/5/20
     * Time: 10:18
     * @Action
     * @Route(method="POST")
     * @return array
     */
    public function getindexMessage()
    {
        return [
            'data'=>$this->RedisService->getRedislpushMessage('indexbroadcast')
        ];
    }

    /**
     * Date: 2021/5/24
     * Time: 14:52
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="search", message="搜索信息不能为空")
     * @Required(name="page", default="1")
     * @Required(name="page_size", default="10")
     * @param string $search
     * @return array
     */
    public function getUserSearch(string $search,string $page,string $page_size)
    {
        return [
            'data' => $this->UserService->nickNameAndIdSearch($search,$page,$page_size),
        ];
    }
}

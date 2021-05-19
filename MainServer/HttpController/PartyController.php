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
 * @Controller("/Party/")
 */
class PartyController extends  SingletonHttpController
{
    /**
     * @Inject("RoomService")
     */
    protected $RoomService;
    /**
     * Date: 2021/5/19
     * Time: 11:51
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="page", default="1")
     * @Required(name="page_size", default="10")
     */
    public function recommend(string $page,string $page_size)
    {
        return [
            'data'=>$this->RoomService->roomRanking($page,$page_size)
        ];
    }

    /**
     * Date: 2021/5/19
     * Time: 14:08
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="label", message="标签不能为空")
     * @return array
     */
    public function roomLabelSearch(string $label)
    {
        return [
            'data'=>$this->RoomService->roomLabelSearch($label)
        ];
    }
}
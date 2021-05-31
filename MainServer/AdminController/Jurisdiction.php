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
 * Class Jurisdiction
 * @package ImiApp\MainServer\AdminController
 * @Controller("/Jurisdiction/")
 */
class Jurisdiction extends SingletonHttpController
{
    /**
     * @var
     * @Inject("JurisdictionService")
     */
    protected $JurisdictionService;

    /**
     * Date: 2021/5/28
     * Time: 15:15
     * @Action
     * @Route(metho="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @HttpValidation
     * @Required(name="name", message="模块名称不能为空")
     * @param int $moudle_id
     * @param int $node_id
     * @param string $name
     */
    public function setMoudle(int $moudle,int $node,string $name)
    {
        $this->JurisdictionService->setMoudle($name);
    }

    /**
     * Date: 2021/5/28
     * Time: 16:24
     * @Action
     * @Route(metho="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @HttpValidation
     * @Required(name="name", message="节点名称不能为空")
     * @param int $moudle
     * @param int $node
     * @param string $name
     * @param string $moudle_id
     */
    public function setNode(int $moudle,int $node,string $name,string $moudle_id)
    {
        $this->JurisdictionService->setNode($name,$moudle_id);
    }

    /**
     * Date: 2021/5/31
     * Time: 13:39
     * @Action
     * @Route(metho="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @param int $moudle
     * @param int $node
     * @param string $moudle_id
     */
    public function deleteMoudle(int $moudle,int $node,int $moudle_id)
    {
        $this->JurisdictionService->deleteMoudle($moudle_id);
    }

    /**
     * Date: 2021/5/31
     * Time: 13:39
     * @Action
     * @Route(metho="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @param int $moudle
     * @param int $node
     * @param string $node_id
     */
    public function deleteNode(int $moudle,int $node,int $node_id)
    {
        $this->JurisdictionService->deleteNode($node_id);
    }

    /**
     * Date: 2021/5/31
     * Time: 14:07
     * @Action
     * @Route(POST)
     * @HttpValidation
     * @Required(name="page", default="1")
     * @Required(name="page_size", default="10")
     */
    public function getJurisdictionList(int $page,int $page_size)
    {
        return [
            'data'=>$this->JurisdictionService->getJurisdictionList($page,$page_size),
        ];
    }
}
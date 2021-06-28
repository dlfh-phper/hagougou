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
 * Class Agreement
 * @package ImiApp\MainServer\AdminController
 * @Controller("/Agreement/");
 */
class Agreement extends SingletonHttpController
{
    /**
     * @var
     * @Inject("AgreementService");
     */
    protected $AgreementService;

    /**
     * Date: 2021/6/28
     * Time: 14:37
     * @Action
     * @Route(method="POST")
     * @param int $page
     * @param int $page_size
     * @return array
     */
    public function getAgreementList(int $page,int $page_size)
    {
        return [
          'data' => $this->AgreementService->getAgreementList($page,$page_size)
        ];
    }

    /**
     * Date: 2021/6/28
     * Time: 14:38
     * @Action
     * @Route(method="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @HttpValidation
     * @Required(name="content", message="协议信息不能为空")
     * @Required(name="type", message="类型信息不能为空")
     * @param string $content
     * @param int $type
     * @param int $id
     */
    public function setAgreement(string $content,int $type,int $id)
    {
        $this->AgreementService->setAgreement($content,$type,$id);
    }

    /**
     * Date: 2021/6/28
     * Time: 14:52
     * @Action
     * @Route(method="POST")
     * @param int $id
     * @return array
     */
    public function getFindAgreement(int $id)
    {
        return [
            'data' => $this->AgreementService->getFindAgreement($id)
        ];
    }
}
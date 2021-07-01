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
 * Class Emoticon
 * @package ImiApp\MainServer\AdminController
 * @Controller("/Emoticon/")
 */
class Emoticon  extends SingletonHttpController
{
    /**
     * @var
     * @Inject("EmoticonService")
     */
    protected $EmoticonService;

    /**
     * Date: 2021/7/1
     * Time: 15:59
     * @Action
     * @Route(method="POST")
     * @param int $page
     * @param int $page_size
     */
    public function getEmoticonList(int $page,int $page_size)
    {
        return [
            'data' => $this->EmoticonService->getEmoticonList($page,$page_size)
        ];
    }

    /**
     * Date: 2021/7/1
     * Time: 16:01
     * @Action
     * @Route(method="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @HttpValidation
     * @Required(name="url", message="图片不能为空")
     * @Required(name="name", message="名称不能为空")
     * @param string $url
     * @param string $name
     * 设置礼物
     */
    public function setEmoticon(string $url,string $name)
    {
        $this->EmoticonService->setEmoticon($url,$name);
    }

    /**
     * Date: 2021/7/1
     * Time: 16:15
     * @Action
     * @Route(method="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @param string $id
     */
    public function EmoticonDeleTe(string $id)
    {
        $this->EmoticonService->EmoticonDeleTe($id);
    }

    /**
     * Date: 2021/7/1
     * Time: 16:16
     * @Action
     * @Route(method="POST")
     * @param int $id
     */
    public function getFind(int $id)
    {
        return [
            'data' => $this->EmoticonService->getFind($id)
        ];
    }
}
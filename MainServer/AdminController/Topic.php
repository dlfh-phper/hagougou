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
 * Class Topic
 * @package ImiApp\MainServer\AdminController
 * @Controller("/Topic/")
 */
class Topic extends SingletonHttpController
{

    /**
     * @var
     * @Inject("TopicService")
     */
    protected $TopicService;
    /**
     * Date: 2021/6/7
     * Time: 15:15
     * @Action
     * @Route(method="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     */
    public function setTopic(string $label,string $url,int $id)
    {
        return [
          'data' => $this->TopicService->setTopic($label,$url,$id),
        ];
    }

    /**
     * Date: 2021/6/7
     * Time: 15:28
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="page", default="1")
     * @Required(name="page_size", default="10")
     * @param int $page
     * @param int $page_size
     * @return array
     */
    public function getTopiclist(int $page,int $page_size)
    {
        return [
            'data' => $this->TopicService->getTopiclist($page,$page_size),
        ];
    }

    /**
     * Date: 2021/6/7
     * Time: 15:30
     * @Action
     * @Route(method="POST")
     * @Middleware(\ImiApp\MainServer\Middleware\AdminJurisdiction::class)
     * @param string $id
     * @return array
     */
    public function deleteTopic(string $id)
    {
        return [
            'data' => $this->TopicService->deleteTopic($id),
        ];
    }
}
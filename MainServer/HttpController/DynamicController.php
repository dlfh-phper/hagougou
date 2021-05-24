<?php


namespace ImiApp\MainServer\HttpController;


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
/**
 * Class DynamicController
 * @package ImiApp\MainServer\HttpController
 * @Controller("/Dynamic/")
 */
class DynamicController extends SingletonHttpController
{

    /**
     * @Inject("DynamicService")
     * @var
     */
    protected $DynamicService;
    /**
     * Date: 2021/5/24
     * Time: 16:42
     * @Action
     * @Route(method="POST")
     * @HttpValidation
     * @Required(name="text", message="文字内容不能为空")
     * @Text(name="text",max=700, message="文字内容最多700字,包含空格字符")
     * @param string $text
     * @param string $url
     */
    public function setSquareDynamic(string $text,string $url)
    {
        return [
            'data' => $this->DynamicService->setWechat($text,$url)
        ];
    }
}
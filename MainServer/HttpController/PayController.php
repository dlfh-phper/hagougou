<?php


namespace ImiApp\MainServer\HttpController;


use Imi\Controller\SingletonHttpController;
use Imi\RequestContext;
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
 * Class PayController
 * @package ImiApp\MainServer\HttpController
 * @Controller("pay");
 */
class PayController extends SingletonHttpController
{
    /**
     * @Inject("PayService")
     * @var
     */
    protected $PayService;

    /**
     * Date: 2021/6/2
     * Time: 14:31
     * @Action
     * @Route(method="POST")
     * @return array
     */
    public function wxpay(string $openid)
    {
        return [
          'data' =>$this->PayService->wxpay($openid),
        ];
    }

    /**
     * Date: 2021/6/2
     * Time: 14:34
     * @Action
     * @Route(method="POST")
     */
    public function wxcallbacku()
    {
        $sdk = new \Yurun\PaySDK\Weixin\SDK($this->params);
        $payNotify = new class extends \Yurun\PaySDK\Weixin\Notify\Pay {
            /**
             * 后续执行操作
             * @return void
             */
            protected function __exec()
            {
                var_export($this->data);
            }
        };
        $context = RequestContext::getContext();
        // 下面两行很关键
        $payNotify->swooleRequest = $context['request'];
        $payNotify->swooleResponse = $context['response'];
        $sdk->notify($payNotify);

        // 这句话必须填写
        return $payNotify->swooleResponse;
    }
}
<?php


namespace ImiApp\MainServer\Service;
use EasySwoole\Pay\WeChat\Config;
use EasySwoole\Pay\WeChat\WeChatPay\OfficialAccount;
use EasySwoole\Spl\SplBean;
use Imi\RequestContext;
use ImiApp\MainServer\Exception\BusinessException;
use ImiApp\MainServer\Model\Paylog;
use Yurun\Util\YurunHttp;
use Imi\Bean\Annotation\Bean;
YurunHttp::setDefaultHandler('Yurun\Util\YurunHttp\Handler\Swoole');

/**
 * Class PayService
 * @package ImiApp\MainServer\Service.
 * @Bean("PayService");
 */
class PayService
{
    protected $wxapppid='';
    protected $wxmachid='';
    protected $wxkey='';
    /**
     * @var
     * 微信支付参数
     */
    protected $configparams;
    public function __construct()
    {
        $this->params=new \Yurun\PaySDK\Weixin\Params\PublicParams;
        $this->params->appID=$this->wxapppid;
        $this->params->mch_id=$this->wxmachid;
        $this->params->key=$this->wxkey;
    }
    public function wxpay(string $openid)
    {

        $callbackurl='https://api.haihaixingqiu.com/pay/wxcallbacku';
        $pay = new \Yurun\PaySDK\Weixin\SDK($this->params);
        $request = new \Yurun\PaySDK\Weixin\APP\Params\Pay\Request;
        $request->body = '烈焰商城订单支付'; // 商品描述
        $request->out_trade_no = $out_trade_no; // 订单号
        $request->total_fee = '1'; // 订单总金额，单位为：分
        $request->spbill_create_ip = '47.100.50.44'; // 客户端ip，必须传正确的用户ip，否则会报错
        $request->notify_url = $callbackurl; // 异步通知地址
        $request->openid = $openid;
        $result = $pay->execute($request);
        if($pay->checkResult())
        {
            $clientRequest = new \Yurun\PaySDK\Weixin\APP\Params\Client\Request;
            $clientRequest->prepayid = $result['prepay_id'];
            $pay->prepareExecute($clientRequest, $url, $data);
            return $data;
        }else {
            throw new BusinessException($pay->getErrorCode() . ':' . $pay->getError());
        }
    }
    public function easywxpay(string $openid)
    {
        try{
            $out_trade_no=uniqid().rand(1000,9999);
            $info=Paylog::newInstance();
            $info->setAddTime(time());
            $info->setOpenid($openid);
            $info->setStatus(1);
            $info->setOutTradeNo($out_trade_no);
            $info->insert();
            $wechatConfig = new Config();
            $wechatConfig->setAppId('xxxxxx');      // 除了小程序以外使用该APPID
            $wechatConfig->setMiniAppId('xxxxxx');  // 小程序使用该APPID
            $wechatConfig->setMchId('xxxxxx');
            $wechatConfig->setKey('xxxxxx');
            $wechatConfig->setNotifyUrl('xxxxx');
            $wechatConfig->setApiClientCert('xxxxxxx');//客户端证书
            $wechatConfig->setApiClientKey('xxxxxxx'); //客户端证书秘钥
            $officialAccount = new \EasySwoole\Pay\WeChat\RequestBean\OfficialAccount();
            $officialAccount->setOpenid('xxxxxxx');
            $officialAccount->setOutTradeNo($out_trade_no);
            $officialAccount->setBody('微信支付');
            $officialAccount->setTotalFee(1);
            $officialAccount->setSpbillCreateIp('139.196.231.67');
            $pay = new \EasySwoole\Pay\Pay();
            $params = $pay->weChat($wechatConfig)->officialAccount($officialAccount);
        }catch (BusinessException $bu){
            throw new BusinessException($bu->getMessage());
        }

    }
    public function send()
    {
        $sdk = new \Yurun\PaySDK\Weixin\SDK($this->params);
        $payNotify = new class extends \Yurun\PaySDK\Weixin\Notify\Pay
        {
            /**
             * 后续执行操作
             * @return void
             */
            protected function __exec()
            {

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
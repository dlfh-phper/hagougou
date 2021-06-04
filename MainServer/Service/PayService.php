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
    public function easywxpay(string $openid)
    {
        try{
            $callbackurl='https://api.haihaixingqiu.com/pay/wxcallbacku';
            $out_trade_no=uniqid().rand(1000,9999);
            $info=Paylog::newInstance();
            $info->setAddTime(time());
            $info->setOpenid($openid);
            $info->setStatus(1);
            $info->setOutTradeNo($out_trade_no);
            $info->insert();
            $wechatConfig = new Config();
            $wechatConfig->setAppId('wx1b69b2af6dbd0f33');      // 除了小程序以外使用该APPID
            $wechatConfig->setMchId('1609120467');
            $wechatConfig->setKey('c990d4de6242a289f817ff39eefac891');
            $wechatConfig->setNotifyUrl($callbackurl);
            $wechatConfig->setApiClientCert(getcwd().'/cert/apiclient_cert.pem');//客户端证书
            $wechatConfig->setApiClientKey(getcwd().'/cert/apiclient_key.pem'); //客户端证书秘钥
            $officialAccount = new \EasySwoole\Pay\WeChat\RequestBean\OfficialAccount();
            $officialAccount->setOpenid($openid);
            $officialAccount->setOutTradeNo($out_trade_no);
            $officialAccount->setBody('微信支付');
            $officialAccount->setTotalFee(1);
            $officialAccount->setSpbillCreateIp('139.196.231.67');
            $pay = new \EasySwoole\Pay\Pay();
            $params = $pay->weChat($wechatConfig)->officialAccount($officialAccount);
            return $params;
        }catch (BusinessException $bu){
            throw new BusinessException($bu->getMessage());
        }

    }
}
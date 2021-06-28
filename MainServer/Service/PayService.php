<?php


namespace ImiApp\MainServer\Service;

use EasySwoole\Pay\WeChat\Config;
use EasySwoole\Pay\WeChat\WeChatPay\App;
use EasySwoole\Pay\WeChat\WeChatPay\OfficialAccount;
use EasySwoole\Spl\SplBean;
use Imi\RequestContext;
use ImiApp\MainServer\Exception\BusinessException;
use ImiApp\MainServer\Model\Paylog;
use ImiApp\MainServer\Model\Rechargelog;
use ImiApp\MainServer\Model\User;
use Imi\Bean\Annotation\Bean;
use Imi\Aop\Annotation\Inject;
/**
 * Class PayService
 * @package ImiApp\MainServer\Service.
 * @Bean("PayService");
 */
class PayService
{
    /**
     * @var
     * @Inject("UserService");
     */
    protected $UserService;

    /**
     * Date: 2021/6/18
     * Time: 10:55
     * @param string $openid
     * @return \EasySwoole\Pay\WeChat\ResponseBean\OfficialAccount
     * @throws BusinessException
     * 供公众号支付
     */
    public function easywxpay(string $openid)
    {
        try {
            $callbackurl = 'https://api.haihaixingqiu.com/pay/wxcallbacku';
            $out_trade_no = uniqid().rand(1000, 9999);
            $info = Paylog::newInstance();
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
        } catch (BusinessException $bu) {
            throw new BusinessException($bu->getMessage());
        }
    }

    /**
     * Date: 2021/6/16
     * Time: 15:06
     * app微信充值
     * @param int $price
     * @param int $uid
     * @return \EasySwoole\Pay\WeChat\ResponseBean\App
     */
    public function AppWxRecharge(int $price, int $uid, string $type)
    {
        try {
            if($this->UserService->getUserInfo($uid)->getRealname()==0){
                throw new BusinessException('请进行实名认证');
            }
            $out_trade_no = $uid.date('YmdHis').rand(100000, 999999);
            $info = Rechargelog::newInstance();
            $info->setUid($uid);
            $info->setStatus(1);
            $info->setAddTime(time());
            $info->setOutTradeNo($out_trade_no);
            $info->setType($type);
            $info->setPayRoute('1');
            $info->insert();
            $callbackurl = 'https://api.haihaixingqiu.com/pay/RechargeCallbackUrl';
            $wechatConfig = new Config();
            $wechatConfig->setAppId('wx4be7cbdce64107ed');      // 除了小程序以外使用该APPID
            $wechatConfig->setMchId('1609120467');
            $wechatConfig->setKey('c990d4de6242a289f817ff39eefac891');
            $wechatConfig->setNotifyUrl($callbackurl);
            $wechatConfig->setApiClientCert(getcwd().'/cert/apiclient_cert.pem');//客户端证书
            $wechatConfig->setApiClientKey(getcwd().'/cert/apiclient_key.pem'); //客户端证书秘钥
            $app = new \EasySwoole\Pay\WeChat\RequestBean\App();
            $app->setBody('嗨嗨星球app充值');
            $app->setOutTradeNo($out_trade_no);
            $app->setTotalFee($price);
            $app->setSpbillCreateIp('139.196.231.67');
            $pay = new \EasySwoole\Pay\Pay();
            $result = $pay->weChat($wechatConfig)->app($app);
            return $result;
        } catch (BusinessException $bu) {
            throw new BusinessException($bu->getMessage());
        }

    }

    /**
     * Date: 2021/6/28
     * Time: 15:56
     * @param int $page
     * @param int $page_size
     * @return array
     */
    public function getRechargeLog(int $page,int $page_size)
    {
        return [
            'list' => Rechargelog::query()->page($page,$page_size)->order('id','desc')->select()->getArray(),
            'count' => Rechargelog::count()
        ];

    }
}
<?php


namespace ImiApp\MainServer\HttpController;


use Imi\Controller\SingletonHttpController;
use Imi\Db\Db;
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
use ImiApp\MainServer\Model\Rechargelog;
use ImiApp\MainServer\Model\User;

/**
 * Class PayController
 * @package ImiApp\MainServer\HttpController
 * @Controller("/pay/");
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
          'data' =>$this->PayService->easywxpay($openid),
        ];
    }

    /**
     * Date: 2021/6/18
     * Time: 10:30
     * @Action
     * @Route(method="POST")
     * @param int $parice
     * @param string $type
     * @return array
     */
    public function apppay(int $price,string $type)
    {
        return [
            'data' =>$this->PayService->AppWxRecharge($price,Session::get('user_id'),$type),
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
        $content=$this->request->getBody();
        $jsonxml = json_encode(simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA));
        $params = json_decode($jsonxml, true);
        if($params['return_code'] == 'SUCCESS' && $params['result_code'] == 'SUCCESS'){
            $data['status']=2;
            $data['complete_time']=time();
            $data['trade_no']=$params['transaction_id'];
            Db::query()->table('paylog')->where('out_trade_no','=',$params['out_trade_no'])->update($data);
            \EasySwoole\Pay\WeChat\WeChat::success();
        }else{
            \EasySwoole\Pay\WeChat\WeChat::fail();
        }
    }

    /**
     * Date: 2021/6/16
     * Time: 15:47
     * @Action
     * @Route(method="POST")
     */
    public function RechargeCallbackUrl()
    {
        $content=$this->request->getBody();
        $jsonxml = json_encode(simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA));
        $params = json_decode($jsonxml, true);
        if($params['return_code'] == 'SUCCESS' && $params['result_code'] == 'SUCCESS'){
            $rechargelog=Rechargelog::find([
                'out_trade_no' => $params['out_trade_no']
            ]);
            if($rechargelog){
                $payer_total=json_decode($params['amount'],true);
                if($rechargelog->getType()=='ios'){
                    //ios充值要扣掉30%的平台税
                    $payer_total=$payer_total-($payer_total * 0.3);
                }
                $rechargelog->setCompleteTime(time());
                $rechargelog->setStatus(2);
                $rechargelog->setPrice($payer_total);
                $rechargelog->update();
                //修改账户余额
                User::query()->where('user_id','=',$rechargelog->getUid())->setFieldInc('balance',$payer_total)->update();
            }else{
                \EasySwoole\Pay\WeChat\WeChat::fail();
            }
            \EasySwoole\Pay\WeChat\WeChat::success();
        }else{
            \EasySwoole\Pay\WeChat\WeChat::fail();
        }
    }
    /**
     * Date: 2021/6/4
     * Time: 11:22
     * @Action
     * @Route(method="POST")
     * @param $code
     * @return array
     */
    public function getOpenid($code)
    {
        $token="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx1b69b2af6dbd0f33&secret=af9c9d73077a3663af700629b20b54fa&code={$code}&grant_type=authorization_code";
        $token=file_get_contents($token);
        $token=json_decode($token,true);
        return [
            'data' =>  $token,
        ];
    }
}
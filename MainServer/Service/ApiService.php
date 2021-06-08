<?php


namespace ImiApp\MainServer\Service;
use Imi\Bean\Annotation\Bean;
use Imi\Config;
use ImiApp\MainServer\Exception\BusinessException;
use OSS\OssClient;
use OSS\Core\OssException;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;
use Darabonba\OpenApi\Models\Config as aliConfig;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;

/**
 * Class ApiService
 * @package ImiApp\MainServer\Service
 * @Bean("ApiService")
 */
class ApiService
{
    /**
     * Date: 2021/5/20
     * Time: 16:36
     * @param $name
     * @param $tmp_name
     * @return mixed
     * @throws BusinessException
     * 文件上传
     */
    public function Upload($name,$tmp_name)
    {
        $config=Config::get('@server.main.beans.aliyun');
        $format = strrchr($name, '.');//截取文件后缀名如 (.jpg)
        /*判断图片格式*/
        $allow_type = ['.jpg', '.jpeg', '.gif', '.bmp', '.png','.mp4','.mp3','.aac','.m4a','.pdf','.svga'];
        if (!in_array($format, $allow_type)) {
            throw new BusinessException('文件格式不被允许');
        }
        // 尝试执行
        try {
            // 实例化对象 将配置传入
            $ossClient = new OssClient($config['key'], $config['Secret'], $config['endpoint']);
            // 这里是有sha1加密 生成文件名 之后连接上后缀
            $fileName = 'uplaod/image/' . date("Ymd") . '/' . sha1(date('YmdHis', time()) . uniqid()) . $format;
            //执行阿里云上传
            $result =  $ossClient->uploadFile($config['bucket'], $fileName, $tmp_name);
            /*组合返回数据*/
//            $arr = [
//                'oss_url' => $result['info']['url'],  //上传资源地址
//                'relative_path' => $fileName     //数据库保存名称(相对路径)
//            ];
            $arr=$result['oss-request-url'];
            return $arr;
        } catch (OssException $e) {
            throw new BusinessException($e->getMessage());
        }
    }

    /**
     * Date: 2021/5/20
     * Time: 17:00
     * @param $phone
     * @param $code
     * @return \AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsResponse
     * 短信发送
     */
    public function sendSms($phone,$code)
    {
//        $config=Config::get('@server.main.beans.aliyun');
//        $aliConfig = new aliConfig([
//            // 您的AccessKey ID
//            "accessKeyId" => $config['key'],
//            // 您的AccessKey Secret
//            "accessKeySecret" => $config['Secret']
//        ]);
//        // 访问的域名
//        $config->endpoint = "dysmsapi.aliyuncs.com";
//        $client=new Dysmsapi($aliConfig);
//        $sendSmsRequest = new SendSmsRequest([
//            "phoneNumbers" => $phone,
//            "templateCode" => $config['templateCode'],
//            "signName" => $config['signName'],
//            "templateParam" => $code
//        ]);
//        // 复制代码运行请自行打印 API 的返回值
//        $result=$client->sendSms($sendSmsRequest);
        return true;
    }

}
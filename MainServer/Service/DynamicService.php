<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Model\Wechat;
use Imi\Aop\Annotation\Inject;

/**
 * Class DynamicService
 * @package ImiApp\MainServer\Service
 * @Bean("DynamicService")
 */
class DynamicService
{
    /**
     * @Inject("UserSessionService");
     * @var
     */
    protected $UserSessionService;

    /**
     * Date: 2021/5/24
     * Time: 16:40
     * @param string $text
     * @param string $url
     * 发布动态
     */
    public function setWechat(string $text,string $url)
    {
        $info=Wechat::newInstance();
        $info->setText($text);
        $info->setUrl($url);
        $info->setUid($this->UserSessionService->getUserId());
        $info->setFabulous(0);
        $info->setComment(0);
        $info->setAddTime(time());
        $info->update();
    }
}
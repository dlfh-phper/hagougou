<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Model\Reportlog;

/**
 * Class RportFedbackService
 * @package ImiApp\MainServer\Service
 * @Bean("RportFedbackService")
 */
class RportFedbackService
{
    /**
     * Date: 2021/6/28
     * Time: 16:26
     * @param int $report_id
     * @param string $nickname
     * @param string $url
     * @param string $content
     * @param int $type
     * @param int $uid
     * 举报有害信息
     */
    public function ReportHarmfulInfo(int $report_id,string $nickname,string $url,string $content,int $type,int $uid)
    {
        Reportlog::newInstance()
            ->setUid($uid)
            ->setReportId($report_id)
            ->setNickname($nickname)
            ->setUrl($url)
            ->setContent($content)
            ->setType($type)
            ->insert();
    }

    /**
     * Date: 2021/6/28
     * Time: 16:41
     * @param int $page
     * @param int $page_size
     * @return array
     * 获取举报信息列表
     */
    public function getReportList(int $page,int $page_size)
    {
        return [
            'list' => Reportlog::query()->page($page,$page_size)->order('id','desc')->select()->getArray(),
            'count' => Reportlog::count()
        ];
    }
}
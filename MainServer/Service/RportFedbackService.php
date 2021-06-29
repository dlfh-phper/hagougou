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
            ->setStatus(1)
            ->setType($type)
            ->setAddTime(time())
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
    public function getReportList(int $status,int $page,int $page_size)
    {
        return [
            'list' => Reportlog::query()->page($page,$page_size)->where('status','=',$status)->order('id','desc')->select()->getArray(),
            'count' => Reportlog::query()->where('status','=',$status)->select()->getRowCount()
        ];
    }

    /**
     * Date: 2021/6/29
     * Time: 16:07
     */
    public function AppFedback(string $content,int $uid)
    {
        Reportlog::newInstance()->setStatus(2)->setContent($content)->setUid($uid)->setAddTime(time())->insert();
    }
}
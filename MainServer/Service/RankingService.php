<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Model\User;

/**
 * Class RankingService
 * @package ImiApp\MainServer\Service
 * @Bean("RankingService");
 */
class RankingService
{
    /**
     * Date: 2021/6/16
     * Time: 11:40
     * @param int $page
     * @param int $page_size
     * intimacyvalue 亲密值
     * wealthvalue  财富值
     * charmvalue  魅力值
     * cpvalue cp值
     * @return array
     */
    public function RankingService(int $page,int $page_size)
    {
        $list['intimacyvalue'] = User::Query()->order('intimacyvalue', 'desc')->page($page,$page_size)->select()->getArray();
        $list['wealthvalue'] = User::Query()->order('wealthvalue', 'desc')->page($page,$page_size)->select()->getArray();
        $list['charmvalue'] = User::Query()->order('charmvalue', 'desc')->page($page,$page_size)->select()->getArray();
        $list['cpvalue'] = User::Query()->order('cpvalue', 'desc')->page($page,$page_size)->select()->getArray();
        $list['count'] = User::count();
        return $list;
    }
}
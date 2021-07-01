<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Model\Cp;
use ImiApp\MainServer\Model\Intimacy;
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
        $count=User::count();
        //亲密
        $list['intimacyvalue'] =self::intimacy($page,$page_size);
        //财富
        $wealthvalue=[
            'list' => User::Query()->order('wealthvalue', 'desc')->page($page,$page_size)->select()->getArray(),
            'count' => $count
            ];
        $list['wealthvalue'] =$wealthvalue;
        //魅力
        $charmvalue=[
            'list' => User::Query()->order('charmvalue', 'desc')->page($page,$page_size)->select()->getArray(),
            'count' => $count
        ];
        $list['charmvalue'] =$charmvalue;
        //cp
        $list['cpvalue'] = self::cp($page,$page_size);
        return $list;
    }
    public static function intimacy($page,$page_size)
    {
        return [
            'list' => Intimacy::query()->order('countvalue','desc')->page($page,$page_size)->select()->getArray(),
            'count' => Intimacy::count()
        ];
    }
    public static function cp($page,$page_size)
    {
        return [
            'list' => Cp::query()->order('countvalue','desc')->page($page,$page_size)->select()->getArray(),
            'count' => Cp::count()
        ];
    }
}
<?php


namespace ImiApp\MainServer\HttpController;


use Imi\Controller\SingletonHttpController;
use Imi\Aop\Annotation\Inject;
use Imi\Validate\Annotation\Regex;
use Imi\Server\Route\Annotation\Route;
use Imi\Server\Route\Annotation\Action;
use Imi\Server\Route\Annotation\Controller;

/**
 * Class RankingController
 * @package ImiApp\MainServer\HttpController
 * @Controller("/Ranking/")
 */
class RankingController extends SingletonHttpController
{
    /**
     * @var
     * @Inject("RankingService")
     */
    protected $RankingService;

    /**
     * Date: 2021/6/16
     * Time: 11:41
     * @Action
     * @Route(method="POST")
     * @param int $page
     * @param int $page_size
     */
    public function Ranking(int $page, int $page_size)
    {
        return [
            'data' => $this->RankingService->RankingService($page, $page_size),
        ];
    }
}
<?php


namespace ImiApp\MainServer\Service;

use Imi\Bean\Annotation\Bean;
use Imi\Aop\Annotation\Inject;
use ImiApp\MainServer\Model\Agreement;

/**
 * Class AgreementService
 * @package ImiApp\MainServer\Service
 * @Bean("AgreementService")
 */
class AgreementService
{
    /**
     * Date: 2021/6/28
     * Time: 14:28
     * @param int $page
     * @param int $page_size
     * @return array
     * 协议列表
     */
    public function getAgreementList(int $page,int $page_size)
    {
        return [
            'list' => Agreement::query()->page($page,$page_size)->select()->getArray(),
            'count' => Agreement::count()
        ];
    }

    /**
     * Date: 2021/6/28
     * Time: 14:31
     * @param string $content
     * @param int $type
     * @param int $id
     * 添加修改协议
     */
    public function setAgreement(string $content,int $type,int $id)
    {
        $Agreement=Agreement::newInstance();
        $Agreement->content = $content;
        $Agreement->add_time = time();
        $Agreement->type = $type;
        $Agreement->id = $id;
        $Agreement->save();
    }

    /**
     * Date: 2021/6/28
     * Time: 14:34
     * @param int $id
     * @return Agreement|null
     * 详情
     */
    public function getFindAgreement(int $id)
    {
        return Agreement::find($id);
    }

    /**
     * Date: 2021/6/28
     * Time: 15:13
     * @param int $type
     * @return Agreement|null
     * 通过类型获取协议
     */
    public function getTypeAgreement(int $type)
    {
        return Agreement::find(['type' => $type]);
    }
}
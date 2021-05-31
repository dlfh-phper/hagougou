<?php


namespace ImiApp\MainServer\Service;
use Imi\Bean\Annotation\Bean;
use ImiApp\MainServer\Exception\BusinessException;
use ImiApp\MainServer\Model\Adminuser;
use ImiApp\MainServer\Model\Moudle;
use ImiApp\MainServer\Model\Node;

/**
 * Class JurisdictionService
 * @package ImiApp\MainServer\Service
 * @Bean("JurisdictionService");
 */
class JurisdictionService
{

    /**
     * Date: 2021/5/31
     * Time: 13:45
     * @param string $name
     * @throws BusinessException
     * 设置权限模块
     */
    public function setMoudle(string $name)
    {
        $moudle=Moudle::find(['name'=>$name]);
        if($moudle){
            throw new BusinessException("模块已存在");
        }else{
            $info=Moudle::newInstance();
            $info->setName($name);
            $info->setAddTime(time());
            $info->insert();
        }
    }

    /**
     * Date: 2021/5/31
     * Time: 13:45
     * @param string $name
     * @param int $moudle_id
     * @throws BusinessException
     * 设置权限节点，节点在模块下面
     */
    public function setNode(string $name,int $moudle_id)
    {
        $node=Node::find(['node_name'=>$name,'moudle_id'=>$moudle_id]);
        if($node)
        {
            throw new BusinessException("模块下已有该功能");
        }else{
            $info=Node::newInstance();
            $info->setNodeName($name);
            $info->setMoudleId($moudle_id);
            $info->setAddTime(time());
        }
    }

    /**
     * Date: 2021/5/31
     * Time: 13:53
     * @param int $moudle_id
     * @throws BusinessException
     * s删除模块之钱判断下面有没有节点
     */
    public function deleteMoudle(int $moudle_id)
    {
        $node=Node::find(['moudle_id'=>$moudle_id]);
        if($node){
           throw new BusinessException('请先删除模块下面的节点');
        }

        Moudle::find($moudle_id)->delete();
    }

    /**
     * Date: 2021/5/31
     * Time: 13:54
     * @param int $moudle_id
     * 权限节点直接删除
     */
    public function deleteNode(int $node_id)
    {

        Node::find($node_id)->delete();
    }

    /**
     * Date: 2021/5/31
     * Time: 14:11
     * @param int $page
     * @param int $page_size
     */
    public function getJurisdictionList(int $page,int $page_size)
    {
        $list=Moudle::query()->page(($page-1)*$page_size,$page_size)->select()->getArray();
        foreach ($list as $key=>$value)
        {
            $list[$key]=Node::query()->where('moudle_id',$value['id'])->select()->getArray();
        }
        $count=Moudle::count('id');
        return [
           'list'=>$list,
           'count' =>$count
        ];
    }
    /**
     * Date: 2021/5/31
     * Time: 13:45
     * @param int $uid
     * @param int $moudle_id
     * @param int $node_id
     * @throws BusinessException
     * 权限验证
     */
    public function verificationJurisdictionService(int $uid,int $moudle_id,int $node_id)
    {
        $info=Adminuser::find($uid);
        $jurisdiction=json_decode($info->getJurisdiction(),true);
        if(!$jurisdiction==0){
            if(strpos(implode($jurisdiction[$moudle_id-1]['path']),$node_id) ==false)
            {
                throw new BusinessException('权限验证失败,请联系管理员');
            }
        }else{
            throw new BusinessException('您没有权限,请联系管理员');
        }
    }

}
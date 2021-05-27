<?php


namespace ImiApp\MainServer\Service;
use Imi\Bean\Annotation\Bean;
use \Imi\Redis\RedisManager;

/**
 * Class RedisService
 * @package ImiApp\MainServer\Service
 * @Bean("RedisService")
 */
class RedisService
{
    protected $redis;
    public function __construct()
    {
        $this->redis=RedisManager::getInstance();
    }

    /**
     * Date: 2021/5/19
     * Time: 16:48
     * @param $data
     * 设置广播交友队列消息
     */
    public function setRedislpush(string $listname,$data)
    {
        if($this->redis->lLen($listname)>=10){
            $this->redis->rPop($listname);
        }
        $this->redis->lpush($listname,$data);
    }

    /**
     * Date: 2021/5/19
     * Time: 16:50
     * 获取队列最后两条消息
     */
    public function getRedislpushMessage(string $listname)
    {
        $info['msg']=$this->redis->lindex($listname,-9);
        $info['list']=$this->redis->lrange($listname,0,-1);
        return $info;
    }
}
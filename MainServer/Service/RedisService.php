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
    public function setRedislpush($data)
    {
        if($this->redis->lLen('indexbroadcast')>=10){
            $this->redis->rPop('indexbroadcast');
        }
        $this->redis->lpush('indexbroadcast',$data);
    }

    /**
     * Date: 2021/5/19
     * Time: 16:50
     * 获取队列最后两条消息
     */
    public function getRedislpushMessage()
    {
        $info['msg']=$this->redis->lindex('indexbroadcast',-9);
        $info['list']=$this->redis->lrange('indexbroadcast',0,-1);
        return $info;
    }
}
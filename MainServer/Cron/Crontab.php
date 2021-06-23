<?php


namespace ImiApp\MainServer\Cron;

use Imi\Cron\Annotation\Cron;
use Imi\Cron\Contract\ICronTask;
use Imi\Db\Db;
use ImiApp\MainServer\Model\Cp;
use Imi\Aop\Annotation\Inject;
use Imi\Db\Annotation\Transaction;
/**
 * @Cron(id="cpGift", second="1n", type="random_worker")
 */
class Crontab implements ICronTask
{

    /**
     * 执行任务
     *
     * @param string $id
     * @param mixed $data
     * @return void
     * @Transaction
     */
    public function run(string $id, $data)
    {
        $list=Cp::dbQuery()->where('isisAgree')->select()->getArray();
        //发送邀请的时间+24小时大于当前时间代表邀请过期讲礼物财富值退回账户余额
        foreach ($list as $key => $value)
        {
            if($value['add_time']+8600 >time())
            {
                Db::query()->table('user')
                    ->where('user_id','=',$value['give_id'])
                    ->setFieldInc('balance',$value['price'])
                    ->update();
                Db::query()->table('cp')
                    ->where('id','=',$value['id'])
                    ->delete();
            }
        }
    }
}
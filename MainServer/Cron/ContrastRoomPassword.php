<?php


namespace ImiApp\MainServer\Cron;

use Imi\Cron\Annotation\Cron;
use Imi\Cron\Contract\ICronTask;
use Imi\Aop\Annotation\Inject;
use Imi\Db\Annotation\Transaction;
use Imi\Db\Db;

/**
 * @Cron(id="ContrastRoomPassword", second="1n", type="random_worker")
 */
class ContrastRoomPassword  implements ICronTask
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

        $list=Db::query()->table('contrastroompasswordlog')->where('count','=','5')->select()->getArray();
        foreach ($list as $key=>$value)
        {
            if($value['add_time']+8600>time())
            {
                Db::query()->table('contrastroompasswordlog')->where('id','=',$value['id'])->delete();
            }
        }

    }
}
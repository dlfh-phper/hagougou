<?php


namespace ImiApp\Enum;

use Imi\Enum\BaseEnum;
use Imi\Enum\Annotation\EnumItem;
class MessageType  extends BaseEnum
{
    /**
     * @EnumItem("直播")
     */
    const MESSAGE_TYPE_ROOM_PUSH = 1;
    /**
     * @EnumItem("对方邀请")
     */
    const MESSAGE_TYPE_CP_ACCEPT = 2;
}
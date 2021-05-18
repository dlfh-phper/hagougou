<?php
namespace ImiApp\MainServer\Exception;

use ImiApp\Enum\MessageCode;

class BusinessException extends \Exception
{
    public function __construct($message = '网络错误', $code = MessageCode::ERROR, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
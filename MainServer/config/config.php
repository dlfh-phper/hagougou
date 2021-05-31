<?php

use Imi\Log\LogLevel;
return [
    'configs'    =>    [
    ],
    // bean扫描目录
    'beanScan'    =>    [
        'ImiApp\Enum',
        'ImiApp\MainServer\Aop',
        'ImiApp\MainServer\Controller',
        'ImiApp\MainServer\Exception',
        'ImiApp\MainServer\ErrorHandler',
        'ImiApp\MainServer\HttpController',
        'ImiApp\MainServer\Helper',
        'ImiApp\MainServer\Service',
        'ImiApp\MainServer\Model',
        'ImiApp\MainServer\AdminController',
    ],
    'beans'    =>    [
        'SessionManager'    =>    [
            'handlerClass'    =>    \Imi\Server\Session\Handler\File::class,
        ],
        'SessionFile'    =>    [
            'savePath'    =>    dirname(__DIR__, 2) . '/.runtime/.session/',
        ],
        'SessionConfig'    =>    [

        ],
        'SessionCookie'    =>    [
            'enable'    =>  false,
            'lifetime'    =>    86400 * 30,
        ],
        'HttpDispatcher'    =>    [
            'middlewares'    =>    [
                'OptionsMiddleware',
                \Imi\Server\Session\Middleware\HttpSessionMiddleware::class,
                \Imi\Server\WebSocket\Middleware\HandShakeMiddleware::class,
                \Imi\Server\Http\Middleware\RouteMiddleware::class,
            ],
        ],
        'OptionsMiddleware' => [
            // 设置允许的 Origin，为 null 时允许所有，为数组时允许多个
            'allowOrigin'       =>  null,
            // 允许的请求头
            'allowHeaders'      =>  'Authorization, Content-Type, Accept, Origin, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With, X-Id, X-Token, Cookie, x-session-id',
            // 允许的跨域请求头
            'exposeHeaders'     =>  'Authorization, Content-Type, Accept, Origin, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With, X-Id, X-Token, Cookie, x-session-id',
            // 允许的请求方法
            'allowMethods'      =>  'GET, POST, PATCH, PUT, DELETE',
            // 是否允许跨域 Cookie
            'allowCredentials'  =>  'true',
            // 当请求为 OPTIONS 时，是否中止后续中间件和路由逻辑，一般建议设为 true
            'optionsBreak'      =>  true,
        ],
        'HtmlView'    =>    [
            'templatePath'    =>    dirname(__DIR__) . '/template/',
            // 支持的模版文件扩展名，优先级按先后顺序
            'fileSuffixs'        =>    [
                'tpl',
                'html',
                'php'
            ],
        ],
        'HttpErrorHandler' =>[
            'handler'   => \ImiApp\MainServer\ErrorHandler\HttpErrorHandler::class,
        ],
        'HttpSessionMiddleware' =>  [
            'sessionIdHandler'    =>    function(\Imi\Server\Http\Message\Request $request){
                $sessionId = $request->getHeaderLine('X-Session-Id');
                return $sessionId;
            },
        ],
        'WebSocketDispatcher'    =>    [
            'middlewares'    =>    [
                \Imi\Server\WebSocket\Middleware\RouteMiddleware::class,
            ],
        ],
        'ServerGroup' => [
            'status'       => true , // 启用
            'groupHandler' => 'GroupRedis', // 分组处理器，目前仅支持 Redis
        ],
        // 分组 Redis 驱动
        'GroupRedis' => [
            'redisPool' => 'redis',
            'redisDb' => 0, // redis中第几个库
            'heartbeatTimespan' => 5, // 心跳时间，单位：秒.
            'heartbeatTtl' => 8, // 心跳数据过期时间，单位：秒.
            'key' => 'imiRtcRoom', // 该服务的分组键，默认为 imi:命名空间:connect_group
        ],
        // 分组本地驱动，仅支持当前 Worker 进程
        'GroupLocal' => [
            // 无配置项
        ],
        'ConnectContextStore'   =>  [
            'handlerClass'  =>  \Imi\Server\ConnectContext\StoreHandler\Local::class,
        ],
        'ConnectContextLocal'    =>    [
            'lockId'    =>  'redis',
        ],
        'aliyun' => [
            'key' => 'LTAI5tP78X7mh6NPHkrfdmnB',
            'Secret' => 'hYgfwMUElpKkc72wP7Q0IuFIYe2O8E',
            'bucket' => 'hagougou',
            'endpoint' => 'https://oss-cn-shanghai-internal.aliyuncs.com'
        ]
    ],
];

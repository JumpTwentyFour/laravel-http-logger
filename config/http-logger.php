<?php

return [
    'channel' => env('HTTP_LOG_CHANNEL', env('LOG_CHANNEL', 'stack')),

    'log_requests' => env('HTTP_LOG_REQUESTS', true),

    'log_responses' => env('HTTP_LOG_RESPONSES', true),

    'request_logger' => \Jumptwentyfour\LaravelHttpLogger\Loggers\RequestLogger::class,

    'response_logger' => \Jumptwentyfour\LaravelHttpLogger\Loggers\ResponseLogger::class,
];
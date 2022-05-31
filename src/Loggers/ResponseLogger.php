<?php

namespace Jumptwentyfour\LaravelHttpLogger\Loggers;

use Illuminate\Http\Response;
use Jumptwentyfour\LaravelHttpLogger\Contracts\ResponseLoggerContract;

class ResponseLogger implements ResponseLoggerContract
{
    public function __invoke(Response $response, string $channel): void
    {

    }
}
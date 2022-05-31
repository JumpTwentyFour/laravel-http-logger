<?php

namespace Jumptwentyfour\LaravelHttpLogger\Loggers;

use Illuminate\Http\Request;

class RequestLogger implements \RequestLoggerContract
{
    public function __invoke(Request $request, string $channel): void
    {

    }
}
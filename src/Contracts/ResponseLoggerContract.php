<?php

namespace Jumptwentyfour\LaravelHttpLogger\Contracts;

use Illuminate\Http\Response;

interface ResponseLoggerContract
{
    public function __invoke(Response $response, string $channel): void;
}
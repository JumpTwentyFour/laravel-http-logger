<?php

namespace JumpTwentyFour\LaravelHttpLogger\Contracts;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface ResponseLoggerContract
{
    public function __invoke(Request $request, Response $response, string $channel): void;
}
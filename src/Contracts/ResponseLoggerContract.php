<?php

namespace JumpTwentyFour\LaravelHttpLogger\Contracts;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ResponseLoggerContract
{
    public function __invoke(Request $request, Response $response, string $channel): void;
}
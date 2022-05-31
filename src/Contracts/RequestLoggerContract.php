<?php

namespace JumpTwentyFour\LaravelHttpLogger\Contracts;

use Symfony\Component\HttpFoundation\Request;

interface RequestLoggerContract
{
    public function __invoke(Request $request, string $channel): void;
}
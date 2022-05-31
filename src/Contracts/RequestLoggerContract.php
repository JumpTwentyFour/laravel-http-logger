<?php

namespace Jumptwentyfour\LaravelHttpLogger\Contracts;

interface RequestLoggerContract
{
    public function __invoke(\Illuminate\Http\Request $request, string $channel): void;
}
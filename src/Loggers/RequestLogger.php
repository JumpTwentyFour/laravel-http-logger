<?php

namespace JumpTwentyFour\LaravelHttpLogger\Loggers;

use Illuminate\Http\Request;
use Illuminate\Log\LogManager;
use JumpTwentyFour\LaravelHttpLogger\Contracts\RequestLoggerContract;

class RequestLogger implements RequestLoggerContract
{
    private LogManager $logManager;

    public function __construct(LogManager $logManager)
    {
        $this->logManager = $logManager;
    }

    public function __invoke(Request $request, string $channel): void
    {
        $data = [
            'url' => $request->url(),
            'method' => $request->method(),
            'headers' => $request->headers,
            'body' => $request->all(),
            'user' => $request->getUser(),
        ];
        $this->logManager->debug(json_encode($data));
    }
}
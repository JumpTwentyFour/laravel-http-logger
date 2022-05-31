<?php

namespace JumpTwentyFour\LaravelHttpLogger\Loggers;

use Illuminate\Http\Request;
use Illuminate\Log\LogManager;
use JumpTwentyFour\LaravelHttpLogger\Contracts\RequestLoggerContract;
use JumpTwentyFour\LaravelHttpLogger\Traits\FiltersData;

class RequestLogger implements RequestLoggerContract
{
    use FiltersData;

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
            'headers' => $request->headers->all(),
            'body' => $request->all(),
            'user' => $request->getUser(),
        ];
        $data = $this->filter($data);
        $this->logManager->debug('Request: ' . json_encode($data));
    }


}
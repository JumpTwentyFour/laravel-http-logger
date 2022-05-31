<?php

namespace JumpTwentyFour\LaravelHttpLogger\Loggers;

use Symfony\Component\HttpFoundation\Request;
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
            'url' => $request->getRequestUri(),
            'method' => $request->getMethod(),
            'headers' => $request->headers->all(),
            'body' => $request->getContent(),
            'user' => $request->getUser(),
        ];
        $data = $this->filter($data);
        $this->logManager->debug('Request: ' . json_encode($data));
    }


}
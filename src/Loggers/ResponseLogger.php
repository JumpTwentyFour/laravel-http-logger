<?php

namespace JumpTwentyFour\LaravelHttpLogger\Loggers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Log\LogManager;
use JumpTwentyFour\LaravelHttpLogger\Contracts\ResponseLoggerContract;
use JumpTwentyFour\LaravelHttpLogger\Traits\FiltersData;

class ResponseLogger implements ResponseLoggerContract
{
    use FiltersData;

    private LogManager $logManager;

    public function __construct(LogManager $logManager)
    {
        $this->logManager = $logManager;
    }

    public function __invoke(Request $request, Response $response, string $channel): void
    {
        $data = [
            'url' => $request->getUri(),
            'method' => $request->getMethod(),
            'status' => $response->getStatusCode(),
            'headers' => $response->headers->all(),
            'content' => $response->getContent(),
            'user' => $request->getUser(),
        ];

        $data = $this->filter($data);

        $this->logManager->channel($channel)->debug('Response: ' . json_encode($data));
    }
}
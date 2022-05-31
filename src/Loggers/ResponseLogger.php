<?php

namespace JumpTwentyFour\LaravelHttpLogger\Loggers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            'url' => $request->url(),
            'status' => $response->status(),
            'headers' => $response->headers,
            'content' => $response->content(),
        ];

        $data = $this->filter($data);

        $this->logManager->debug('Response: ' . json_encode($data));
    }
}
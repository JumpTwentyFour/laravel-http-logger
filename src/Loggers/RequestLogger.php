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
            'headers' => $request->headers->all(),
            'body' => $request->all(),
            'user' => $request->getUser(),
        ];
        $data = $this->filter($data);
        $this->logManager->debug(json_encode($data));
    }

    public function filter(array $data): array
    {
        return array_map(function ($value, $key) {
            if (in_array(strtolower($key), ['password', 'token', 'authorization'])) {
                return '*********';
            }
            if (is_array($value)) {
                return $this->filter($value);
            }

            return $value;
        }, array_keys($data), array_values($data));
    }
}
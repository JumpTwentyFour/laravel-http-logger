<?php

namespace JumpTwentyFour\LaravelHttpLogger\Middleware;

use Closure;
use Illuminate\Http\Request;
use JumpTwentyFour\LaravelHttpLogger\Contracts\RequestLoggerContract;
use JumpTwentyFour\LaravelHttpLogger\Contracts\ResponseLoggerContract;

class HttpLogger
{
    private ResponseLoggerContract $responseLogger;
    private RequestLoggerContract $requestLogger;
    private string $channel;


    public function __construct(ResponseLoggerContract $responseLogger, RequestLoggerContract $requestLogger)
    {
        $this->responseLogger = $responseLogger;
        $this->requestLogger = $requestLogger;
        $this->channel = config('http-logger.channel');
    }

    public function handle(Request $request, Closure $next)
    {
        if (config('http-logger.log_requests')) {
            $this->requestLogger($request, $this->channel);
        }
        $response = $next($request);
        if (config('http-logger.log_responses')) {
            $this->responseLogger($response, $this->channel);
        }

        return $response;
    }
}
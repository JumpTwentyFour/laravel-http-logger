<?php

namespace JumpTwentyFour\LaravelHttpLogger\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use JumpTwentyFour\LaravelHttpLogger\Contracts\RequestLoggerContract;
use JumpTwentyFour\LaravelHttpLogger\Contracts\ResponseLoggerContract;
use Symfony\Component\HttpFoundation\Response;

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
            ($this->requestLogger)($request, $this->channel);
        }
        $response = $next($request);
        if (config('http-logger.log_responses')) {
            if ($response instanceof Response) {
                ($this->responseLogger)($request, $response, $this->channel);
            } else {
                $type = get_class($response);
                Log::warning("Failed to log response, type {$type} is not supported");
            }
        }

        return $response;
    }
}
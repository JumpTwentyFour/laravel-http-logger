# Laravel HTTP Logger

# Installation

You can install the package via composer:

`composer require spatie/laravel-http-logger`

Optionally you can publish the config file with:

`php artisan vendor:publish --provider="JumpTwentyFour\LaravelHttpLogger\ServiceProvider" --tag="config" `

## Usage

This packages provides a middleware which can be added as a global middleware or as a single route.

```php
// In `app/Http/Kernel.php`

protected $middleware = [
    // ...
    
    \JumpTwentyFour\LaravelHttpLogger\Middleware\HttpLogger::class
];
```

```php
// In a routes file

Route::post(...)->middleware(\JumpTwentyFour\LaravelHttpLogger\Middleware\HttpLogger::class);
```
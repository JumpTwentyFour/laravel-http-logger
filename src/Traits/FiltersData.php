<?php

namespace JumpTwentyFour\LaravelHttpLogger\Traits;

trait FiltersData
{
    protected function filter(array $data): array
    {
        return array_map(function ($key, $value) {
            if (in_array(strtolower($key), ['password', 'token', 'authorization'])) {
                $value = '*********';
            }
            if (is_array($value)) {
                $value = $this->filter($value);
            }

            return [$key => $value];
        }, array_keys($data), array_values($data));
    }
}
<?php

namespace App\DateKeys;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DateCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return Date::of($value, new TebTestDatePolicy());
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (!$value instanceof Date) {
            throw new \InvalidArgumentException('The given value is not an Date instance.');
        }

        return ['date' => (string)$value];
    }
}

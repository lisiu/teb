<?php

namespace App\DateKeys\Key;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class KeyCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return Key::of($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (!$value instanceof Key) {
            throw new \InvalidArgumentException('The given value is not an Key instance.');
        }

        return ['keys' => (string)$value];
    }
}

<?php

namespace App\DateKeys\Date;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DateCast implements CastsAttributes
{
    private DatePolicy $datePolicy;

    public function __construct(DatePolicy $datePolicy)
    {
        $this->datePolicy = $datePolicy;
    }

    public function get($model, string $key, $value, array $attributes)
    {
        return Date::of($value, $this->datePolicy);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (!$value instanceof Date) {
            throw new \InvalidArgumentException('The given value is not an Date instance.');
        }

        return ['date' => (string)$value];
    }
}

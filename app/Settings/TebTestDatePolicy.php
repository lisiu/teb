<?php

declare(strict_types=1);

namespace App\Settings;

use App\DateKeys\Date\DatePolicy;

class TebTestDatePolicy implements DatePolicy
{
    public function oldest(): \DateTimeImmutable
    {
        return new \DateTimeImmutable("1950-01-01 00:00:00");
    }

    public function newest(): \DateTimeImmutable
    {
        return new \DateTimeImmutable("2025-12-31 23:59:59");
    }
}

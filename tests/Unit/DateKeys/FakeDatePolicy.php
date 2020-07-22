<?php
namespace Tests\Unit\DateKeys;

use App\DateKeys\Date\DatePolicy;

class FakeDatePolicy implements DatePolicy
{
    public function oldest(): \DateTimeImmutable
    {
        return new \DateTimeImmutable("2020-01-01 00:00:00");
    }

    public function newest(): \DateTimeImmutable
    {
        return new \DateTimeImmutable("2021-12-31 23:59:59");
    }
}

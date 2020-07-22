<?php

namespace Tests\Unit\DateKeys;

use App\DateKeys\Date\Date;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    public function testDateOlderThanAllowedWillThrowException(): void
    {
        $this->expectException(\DomainException::class);
        Date::of('2019-01-01', new FakeDatePolicy());
    }

    public function testDateNewerThanAllowedWillThrowException(): void
    {
        $this->expectException(\DomainException::class);
        Date::of('2022-01-01', new FakeDatePolicy());
    }

    public function testDateFromString(): void
    {
        $date = Date::of('2020-01-01', new FakeDatePolicy());
        $this->assertEquals('2020-01-01', (string)$date);
    }
}

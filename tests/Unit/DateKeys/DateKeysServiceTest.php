<?php

namespace Tests\Unit\DateKeys;

use App\DateKeys\DateKeysService;
use App\DateKeys\KeyGenerator;
use Tests\TestCase;

class DateKeysServiceTest extends TestCase
{
    public function testInsertKeys()
    {
        $uuid = '91193162-fd18-43d7-bd8c-75bcb2321651';
        $letters = ['a', 'b', 'c', 'd', 'e'];
        $dateFrom = '2021-01-01';
        $dateTo = '2021-01-03';

        $keyGenerator = new KeyGenerator();
        $datePolicy = new FakeDatePolicy();
        $keyLettersPolicy = new FakeKeyLettersPolicy();
        $service = new DateKeysService($keyGenerator, $datePolicy, $keyLettersPolicy);

        $dateKeys = $service->createDateKeysForInsert($dateFrom, $dateTo, $letters, $uuid);

        $this->assertCount(3, $dateKeys);
        $this->assertEquals(
            '01209a1b1c9d3e1a6b2cfdde1a8b4c3dde7abbdc8dce7a5bbccdbe2a3b2c1d6e5a1b0321',
            $dateKeys[2]['keys']
        );
    }
}

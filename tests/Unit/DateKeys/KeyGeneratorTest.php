<?php

namespace Tests\Unit\DateKeys;

use App\DateKeys\Date\Date;
use App\DateKeys\KeyGenerator;
use App\DateKeys\KeyLetters;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class KeyGeneratorTest extends TestCase
{
    public function testCreate()
    {
        $uuid = Uuid::fromString('91193162-fd18-43d7-bd8c-75bcb2321651');
        $letters = KeyLetters::of(['a', 'b', 'c', 'd', 'e'], new FakeKeyLettersPolicy());
        $date = Date::of('2020-01-03', new FakeDatePolicy());
        $expectedKey = '01209a1b1c9d3e1a6b2cfdde1a8b4c3dde7abbdc8dce7a5bbccdbe2a3b2c1d6e5a1b0320';

        $generator = new KeyGenerator();
        $generatedKey = $generator->create($uuid, $letters, $date);

        $this->assertEquals($expectedKey, (string)$generatedKey);
    }
}

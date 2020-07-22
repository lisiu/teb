<?php

namespace Tests\Unit\DateKeys;

use App\DateKeys\Key;
use PHPUnit\Framework\TestCase;

class KeyTest extends TestCase
{

    /**
     * @dataProvider invalidKeyProvider
     */
    public function testCannotCreateInvalidKey(string $key): void
    {
        $this->expectException(\DomainException::class);
        Key::of($key);
    }

    public function invalidKeyProvider(): array
    {
        return [
            'to short' => ['01200120'],
            'to long' => ['0120aaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddy0120'],
            'invalid letter' => ['0120ąaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd0120'],
            'invalid character' => ['0120.aaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd0120'],
            'invalid prefix 1' => ['a120aaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd0120'],
            'invalid prefix 2' => ['0b20aaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd0120'],
            'invalid prefix 3' => ['01c0aaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd0120'],
            'invalid prefix 4' => ['012daaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd0120'],
            'invalid suffix 1' => ['0120aaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddda120'],
            'invalid suffix 2' => ['0120aaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd0b20'],
            'invalid suffix 3' => ['0120aaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd01c0'],
            'invalid suffix 4' => ['0120aaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd012d'],
        ];
    }

    /**
     * @dataProvider keyProvider
     */
    public function testKeyFromString(string $stringKey): void
    {
        $key = Key::of($stringKey);
        $this->assertEquals($stringKey, (string)$key);
    }

    public function keyProvider(): array
    {
        return [
            'standard' => ['0120aaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd0120'],
            'upper-case letters' => ['0120AAAAbbbbccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd0120'],
            'with digits' => ['0120aaaa0000ccccddddaaaabbbbccccddddaaaabbbbccccddddaaaabbbbccccdddd0120'],
        ];
    }
}

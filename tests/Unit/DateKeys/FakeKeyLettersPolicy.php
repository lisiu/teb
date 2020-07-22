<?php
namespace Tests\Unit\DateKeys;

use App\DateKeys\KeyLettersPolicy;

class FakeKeyLettersPolicy implements KeyLettersPolicy
{
    public function countFrom(): int
    {
        return 5;
    }

    public function countTo(): int
    {
        return 7;
    }
}

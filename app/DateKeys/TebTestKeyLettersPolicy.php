<?php

declare(strict_types=1);

namespace App\DateKeys;

class TebTestKeyLettersPolicy implements KeyLettersPolicy
{

    public function countFrom(): int
    {
        return 10;
    }

    public function countTo(): int
    {
        return 10;
    }
}

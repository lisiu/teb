<?php

namespace App\DateKeys;

interface KeyLettersPolicy
{
    public function countFrom(): int;

    public function countTo(): int;
}

<?php

namespace App\DateKeys;

interface DatePolicy
{
    public function oldest(): \DateTimeImmutable;

    public function newest(): \DateTimeImmutable;
}

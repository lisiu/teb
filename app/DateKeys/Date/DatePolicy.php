<?php

namespace App\DateKeys\Date;

interface DatePolicy
{
    public function oldest(): \DateTimeImmutable;

    public function newest(): \DateTimeImmutable;
}

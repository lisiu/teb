<?php

namespace App\DateKeys;

interface DateKeysRepository
{
    public function insertMany(array $models): void;
}

<?php

namespace App\DateKeys;

use App\DateKeys\Date\Date;
use App\DateKeys\Date\DatePolicy;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class DateKeysService
{
    private KeyGenerator $keyGenerator;
    private DatePolicy $datePolicy;
    private KeyLettersPolicy $keyLettersPolicy;

    public function __construct(KeyGenerator $keyGenerator, DatePolicy $datePolicy, KeyLettersPolicy $keyLettersPolicy)
    {
        $this->keyGenerator = $keyGenerator;
        $this->datePolicy = $datePolicy;
        $this->keyLettersPolicy = $keyLettersPolicy;
    }

    public function createDateKeysForInsert(string $dateFrom, string $dateTo, array $letters, string $uuid): array
    {
        $startingDate = Carbon::parse($dateFrom);
        $endingDate = Carbon::parse($dateTo);
        if ($startingDate->gt($endingDate)) {
            throw new \InvalidArgumentException(
                "Starting date '{$startingDate}' greater than ending date '{$endingDate}'"
            );
        }

        $keyLetters = KeyLetters::of($letters, $this->keyLettersPolicy);
        $uuid = Uuid::fromString($uuid);

        $currentDate = $startingDate->copy();
        $dateKeys = [];
        while ($currentDate->lte($endingDate)) {
            $date = Date::of($currentDate->toDateString(), $this->datePolicy);
            $key = $this->keyGenerator->create($uuid, $keyLetters, $date);

            $dateKeys[] = ['date' => (string)$date, 'keys' => (string)$key];
            $currentDate->addDay();
        }

        return $dateKeys;
    }
}

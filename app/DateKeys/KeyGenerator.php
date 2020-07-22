<?php

declare(strict_types=1);

namespace App\DateKeys;

use App\DateKeys\Date\Date;
use App\DateKeys\Key\Key;
use Ramsey\Uuid\UuidInterface;

class KeyGenerator
{
    public function create(UuidInterface $uuid, KeyLetters $letters, Date $date): Key
    {
        $uuidChars = str_split(str_replace('-', '', $uuid->toString()));

        $lettersIterator = $letters->circularIterator();
        $lettersIterator->rewind();

        $year = (string)$date->year();
        $yearPrefix = substr($year, 0, 2);
        $yearSuffix = substr($year, -2, 2);
        $month = str_pad((string)$date->month(), 2, '0', STR_PAD_LEFT);
        $day = str_pad((string)$date->day(), 2, '0', STR_PAD_LEFT);

        $key = array_reduce(
            $uuidChars,
            function (string $carry, string $uuidChar) use ($lettersIterator) {
                $letter = $lettersIterator->current();
                $lettersIterator->next();

                return "{$carry}{$uuidChar}{$letter}";
            },
            ''
        );

        return Key::of("{$month}{$yearPrefix}{$key}{$day}{$yearSuffix}");
    }
}

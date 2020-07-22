<?php

declare(strict_types=1);

namespace App\DateKeys;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

final class Date implements Arrayable
{
    private Carbon $date;

    public static function of(string $date, DatePolicy $policy): self
    {
        return new static(Carbon::parse($date), $policy);
    }

    private function __construct(Carbon $date, DatePolicy $policy)
    {
        $oldest = Carbon::createFromImmutable($policy->oldest());
        $newest = Carbon::createFromImmutable($policy->newest());
        if (!$date->between($oldest, $newest)) {
            //@todo: Replace with specific exception
            throw new \DomainException(
                "Invalid date: {$date}. Should be between {$oldest->format('Y-m-d')} and {$newest->format('Y-m-d')}"
            );
        }
        $this->date = $date;
    }

    public function year(): int
    {
        return $this->date->year;
    }

    public function month(): int
    {
        return $this->date->month;
    }

    public function day(): int
    {
        return $this->date->day;
    }

    public function equals(Date $date): bool
    {
        return $this->date->equalTo($date->date);
    }

    public function __toString()
    {
        return $this->date->toDateString();
    }

    public function toArray()
    {
        return $this->date->toDateString();
    }
}

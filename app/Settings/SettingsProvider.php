<?php
namespace App\Settings;

use App\DateKeys\Date\DatePolicy;
use App\DateKeys\KeyLettersPolicy;
use Illuminate\Contracts\Support\Arrayable;

class SettingsProvider implements Arrayable
{
    private DatePolicy $datePolicy;
    private KeyLettersPolicy $keyLettersPolicy;

    public function __construct(DatePolicy $datePolicy, KeyLettersPolicy $keyLettersPolicy)
    {
        $this->datePolicy = $datePolicy;
        $this->keyLettersPolicy = $keyLettersPolicy;
    }

    public function toArray()
    {
        return [
            'date-range-start' => $this->datePolicy->oldest()->format('Y-m-d'),
            'date-range-stop' => $this->datePolicy->newest()->format('Y-m-d'),
            'key-letters-from' => $this->keyLettersPolicy->countFrom(),
            'key-letters-to' => $this->keyLettersPolicy->countTo(),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\DateKeys\Key;

use Illuminate\Contracts\Support\Arrayable;

final class Key implements Arrayable
{
    private string $key;

    public static function of(string $key): self
    {
        return new static($key);
    }

    private function __construct(string $key)
    {
        if (!preg_match('/^\d{4}[a-z0-9]{64}\d{4}$/i', $key)) {
            //@todo: Replace with specific exception
            throw new \DomainException("Invalid key: {$key}");
        }
        $this->key = $key;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function equals(Key $key): bool
    {
        return $this->key === $key->key;
    }

    public function __toString()
    {
        return $this->key;
    }

    public function toArray()
    {
        return $this->key;
    }
}

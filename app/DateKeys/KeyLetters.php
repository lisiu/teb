<?php

declare(strict_types=1);

namespace App\DateKeys;

use App\Utils\CircularIterator;

final class KeyLetters
{
    private \SplFixedArray $letters;

    public static function of(array $letters, KeyLettersPolicy $policy): self
    {
        return new static($letters, $policy);
    }

    private function __construct(array $letters, KeyLettersPolicy $policy)
    {
        $length = count($letters);
        if ($length < $policy->countFrom() || $length > $policy->countTo()) {
            //@todo: Replace with specific exception
            throw new \DomainException("Invalid letters length: {$length}");
        }

        $this->letters = \SplFixedArray::fromArray(
            array_map(
                function ($letter) {
                    if (mb_strlen($letter) !== 1) {
                        //@todo: Replace with specific exception
                        throw new \DomainException("Invalid length: {$letter}");
                    }
                    if (!preg_match('/^[[:alpha:]]$/iu', $letter)) {
                        //@todo: Replace with specific exception
                        throw new \DomainException("Invalid letter: {$letter}");
                    }

                    return transliterator_transliterate('Latin-ASCII', str_replace(['ź', 'Ź'], ['x', 'X'], $letter));
                },
                $letters
            )
        );
    }

    public function circularIterator(): \Iterator
    {
        return new CircularIterator($this->letters);
    }

    public function __toString()
    {
        return (string)array_reduce($this->letters->toArray(), fn(string $carry, string $item) => $carry . $item, '');
    }
}

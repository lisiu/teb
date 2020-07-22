<?php

namespace Tests\Unit\DateKeys;

use App\DateKeys\KeyLetters;
use PHPUnit\Framework\TestCase;

class KeyLettersTest extends TestCase
{
    /**
     * @dataProvider invalidLetters
     */
    public function testInvalidLetters(array $letters): void
    {
        $this->expectException(\DomainException::class);
        KeyLetters::of($letters, new FakeKeyLettersPolicy());
    }

    public function invalidLetters(): array
    {
        return [
            'to short' => [['a']],
            'to long' => [['a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a']],
            'invalid length' => [['ab', 'a', 'a', 'a', 'a']],
            'invalid letter' => [['1', 'a', 'a', 'a', 'a']],
            'invalid char' => [['.', 'a', 'a', 'a', 'a']],
            'empty char' => [['', 'a', 'a', 'a', 'a']],
        ];
    }

    /**
     * @dataProvider validLetters
     */
    public function testValidLetters(array $letters, string $result): void
    {
        $letters = KeyLetters::of($letters, new FakeKeyLettersPolicy());
        $this->assertEquals($result, (string)$letters);
    }

    public function validLetters(): array
    {
        return [
            'standard' => [['a', 'A', 'a', 'A', 'a'], 'aAaAa'],
            'converted 1' => [['ą', 'ć', 'ę', 'ł', 'ń', 'ó'], 'acelno'],
            'converted 2' => [['ś', 'ź', 'ż', 'a', 'a', 'a'], 'sxzaaa'],
            'converted 3' => [['Ą', 'Ć', 'Ę', 'Ł', 'Ń', 'Ó'], 'ACELNO'],
            'converted 4' => [['Ś', 'Ź', 'Ż', 'A', 'A', 'A'], 'SXZAAA'],
        ];
    }

    public function testCircularIterator(): void
    {
        $letters = KeyLetters::of(['a', 'b', 'c', 'd', 'e'], new FakeKeyLettersPolicy());
        $iterator = $letters->circularIterator();
        $iterator->rewind();

        $this->assertEquals('a', $iterator->current());
        $iterator->next();
        $this->assertEquals('b', $iterator->current());
        $iterator->next();
        $this->assertEquals('c', $iterator->current());
        $iterator->next();
        $this->assertEquals('d', $iterator->current());
        $iterator->next();
        $this->assertEquals('e', $iterator->current());
        $iterator->next();
        $this->assertEquals('a', $iterator->current());
    }
}

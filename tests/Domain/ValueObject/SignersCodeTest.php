<?php
namespace App\Tests\Domain\ValueObject;

use App\Domain\Exception\IllegalCharsException;
use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\Exception\SignersCodeEmptyException;
use App\Domain\ValueObject\SignersCode;
use PHPUnit\Framework\TestCase;

class SignersCodeTest extends TestCase
{
    public function getExceptions(): array
    {
        return [
            ['', SignersCodeEmptyException::class],
            ['ABCDEF', MaxSignersCodeException::class],
            ['ABC', IllegalCharsException::class],
        ];
    }

    /**
     * @test
     * @dataProvider getExceptions
     */
    public function should_throw_exceptions($value, $exception) : void
    {
        $this->expectException($exception);
        new SignersCode($value);
    }

}
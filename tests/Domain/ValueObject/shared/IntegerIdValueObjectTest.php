<?php
namespace App\Tests\Domain\ValueObject\shared;

use App\Domain\Exception\IntegerIdEmptyException;
use App\Domain\ValueObject\shared\IntegerIdValueObject;
use PHPUnit\Framework\TestCase;

class IntegerIdValueObjectTest extends TestCase
{
    public function getExceptions(): array
    {
        return [
            [null, IntegerIdEmptyException::class],
            [0, IntegerIdEmptyException::class],
        ];
    }

    /**
     * @test
     * @dataProvider getExceptions
     */
    public function should_throw_exceptions($value, $exception): void
    {
        $this->expectException($exception);
        new IntegerIdValueObject($value);
    }
}
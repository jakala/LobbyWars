<?php
namespace App\Tests\Domain\ValueObject\shared;

use App\Domain\Exception\CharInvalidException;
use App\Domain\ValueObject\shared\CharValueObject;
use PHPUnit\Framework\TestCase;

class CharValueObjectTest extends TestCase
{
    public function getValues(): array
    {
        return [
            [''],
            ['abcde']
        ];
    }

    /**
     * @test
     * @dataProvider getValues
     */
    public function should_throw_char_invalid_exception($value) : void
    {
        $this->expectException(CharInvalidException::class);
        new CharValueObject($value);
    }
}
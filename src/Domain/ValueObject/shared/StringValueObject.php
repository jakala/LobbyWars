<?php
namespace App\Domain\ValueObject\shared;

class StringValueObject
{
    private ?string $value;

    public function __construct(string $value = null)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}

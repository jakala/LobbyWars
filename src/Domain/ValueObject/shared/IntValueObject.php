<?php
namespace App\Domain\ValueObject\shared;

class IntValueObject
{
    private ?int $value;

    public function __construct(int $value = null)
    {
        $this->value = $value;
    }

    public function value() : int
    {
        return $this->value;
    }


}
<?php
namespace App\Domain\ValueObject;

use App\Domain\ValueObject\shared\IntegerIdValueObject;

class RandomSignerId extends IntegerIdValueObject
{
    public function __construct()
    {
        $value = \random_int(1, 100);
        parent::__construct($value);
    }
}
<?php
namespace App\Domain\ValueObject;

use App\Domain\Entity\ValueObject\Contract\SignerId;

class RandomSignerId extends SignerId
{
    public function __construct()
    {
        $value = \random_int(1, 100);
        parent::__construct($value);
    }
}
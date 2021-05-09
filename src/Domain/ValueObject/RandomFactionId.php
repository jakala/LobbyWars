<?php
namespace App\Domain\ValueObject;

use App\Domain\ValueObject\FactionId;

class RandomFactionId extends FactionId
{
    public function __construct()
    {
        $value = \random_int(1, 100);
        parent::__construct($value);
    }
}
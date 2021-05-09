<?php
namespace App\Domain\Entity;

use App\Domain\ValueObject\shared\IntegerIdValueObject;
use App\Domain\ValueObject\SignerAmount;
use App\Domain\ValueObject\SignerKey;

class EmptySigner extends AbstractSigner
{
    public function __construct(IntegerIdValueObject $id)
    {
        $amount = new SignerAmount(0);
        $key = new SignerKey('#');
        parent::__construct($id, $amount, $key);
    }
}

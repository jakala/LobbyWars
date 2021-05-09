<?php
namespace App\Domain\Entity;

use App\Domain\ValueObject\shared\IntegerIdValueObject;
use App\Domain\ValueObject\SignerAmount;
use App\Domain\ValueObject\SignerKey;

class NotarySigner extends AbstractSigner
{
    public function __construct(IntegerIdValueObject $id)
    {
        $amount = new SignerAmount(2);
        $key = new SignerKey('N');
        parent::__construct($id, $amount, $key);
    }
}

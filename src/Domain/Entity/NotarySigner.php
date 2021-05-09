<?php
namespace App\Domain\Entity;

use App\Domain\Entity\ValueObject\Contract\SignerAmount;
use App\Domain\Entity\ValueObject\Contract\SignerKey;
use App\Domain\ValueObject\shared\IntegerIdValueObject;

class NotarySigner extends AbstractSigner
{
    public function __construct(IntegerIdValueObject $id)
    {
        $amount = new SignerAmount(2);
        $key = new SignerKey('N');
        parent::__construct($id, $amount, $key);
    }
}
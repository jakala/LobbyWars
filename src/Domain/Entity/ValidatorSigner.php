<?php
namespace App\Domain\Entity;

use App\Domain\ValueObject\shared\IntegerIdValueObject;
use App\Domain\ValueObject\SignerAmount;
use App\Domain\ValueObject\SignerKey;

class ValidatorSigner extends AbstractSigner
{
    public function __construct(IntegerIdValueObject $id)
    {
        $amount = new SignerAmount(1);
        $key = new SignerKey('V');
        parent::__construct($id, $amount, $key);
    }
}

<?php
namespace App\Domain\Entity;

use App\Domain\ValueObject\shared\IntegerIdValueObject;
use App\Domain\ValueObject\SignerAmount;
use App\Domain\ValueObject\SignerKey;

class KingSigner extends AbstractSigner
{
    public function __construct(IntegerIdValueObject $id)
    {
        $amount = new SignerAmount(5);
        $key = new SignerKey('K');
        parent::__construct($id, $amount, $key);
    }
}

<?php
namespace App\Domain\Entity;

use App\Domain\Entity\ValueObject\Contract\SignerAmount;
use App\Domain\Entity\ValueObject\Contract\SignerKey;
use App\Domain\ValueObject\shared\IntegerIdValueObject;

class KingSigner extends AbstractSigner
{
    public function __construct(IntegerIdValueObject $id)
    {
        $amount = new SignerAmount(5);
        $key = new SignerKey('K');
        parent::__construct($id, $amount, $key);
    }
}
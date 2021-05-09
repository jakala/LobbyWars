<?php
namespace App\Domain\Entity;

use App\Domain\Entity\ValueObject\Contract\SignerAmount;
use App\Domain\Entity\ValueObject\Contract\SignerKey;
use App\Domain\ValueObject\shared\IntegerIdValueObject;

abstract class AbstractSigner implements SignerInterface
{
    private IntegerIdValueObject $id;
    private SignerAmount $amount;
    private SignerKey $key;

    public function __construct(IntegerIdValueObject $id, SignerAmount $amount, SignerKey $key)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->key = $key;
    }

    /**
     * @return IntegerIdValueObject
     */
    public function getId(): IntegerIdValueObject
    {

        return $this->id;
    }

    /**
     * @return SignerAmount
     */
    public function amount(): SignerAmount
    {
        return $this->amount;
    }

    /**
     * @return SignerKey
     */
    public function key(): SignerKey
    {
        return $this->key;
    }
}
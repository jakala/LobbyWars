<?php

namespace App\Domain\Entity;

use App\Domain\Entity\ValueObject\Contract\FactionId;
use App\Domain\Entity\ValueObject\Contract\SignersCode;
use App\Domain\Exception\MaxSignersCodeException;
use SignerInterface;

class faction
{
    public const MAX_SIGNERS = 3;

    /** @var FactionId $id */
    private FactionId $id;

    /** @var SignerInterface[] $signers  */
    private array $signers;

    /**
     * faction constructor.
     * @param FactionId $id
     */
    public function __construct(FactionId $id)
    {
        $this->id = $id;
    }

    /**
     * @return FactionId
     */
    public function getId(): FactionId
    {
        return $this->id;
    }

    /**
     * @throws MaxSignersCodeException
     */
    public function addSigner( SignerInterface $signer): void
    {
        if(self::MAX_SIGNERS === count($this->signers)) {
            throw new MaxSignersCodeException('Cannot add signer. Max:'.self::MAX_SIGNERS);
        }

        $this->signers[] = $signer;
    }

    /**
     * @return SignersCode
     */
    public function getSignersCode() : SignersCode
    {
        return new SignersCode($this->signers, self::MAX_SIGNERS);
    }
}
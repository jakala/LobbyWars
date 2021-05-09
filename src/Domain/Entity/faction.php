<?php

namespace App\Domain\Entity;

use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\ValueObject\FactionId;
use App\Domain\ValueObject\SignersCount;

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
     * @return
     */
    public function getSignersCount() : SignersCount
    {
        return new SignersCount($this->signers, self::MAX_SIGNERS);
    }
}
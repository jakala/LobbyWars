<?php

namespace App\Domain\Entity;

use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\ValueObject\RandomFactionId;
use App\Domain\ValueObject\SignersCount;

class faction
{
    private const MAX_SIGNERS = 3;

    /** @var RandomFactionId $id */
    private RandomFactionId $id;

    /** @var SignerInterface[] $signers  */
    private array $signers;

    /**
     * faction constructor.
     * @param RandomFactionId $id
     */
    public function __construct(RandomFactionId $id)
    {
        $this->id = $id;
        $this->signers =[];
    }

    /**
     * @return RandomFactionId
     */
    public function getId(): RandomFactionId
    {
        return $this->id;
    }

    /**
     * @throws MaxSignersCodeException
     */
    public function addSigner(SignerInterface $signer): void
    {
        if (self::MAX_SIGNERS === count($this->signers)) {
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

    public function hasKing() :bool
    {
        foreach ($this->signers as $signer) {
            if ($signer->key()->value() === 'K') {
                return true;
            }
        }

        return false;
    }
}

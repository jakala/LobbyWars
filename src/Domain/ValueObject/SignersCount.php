<?php
namespace App\Domain\ValueObject;

use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\Exception\SignersCodeEmptyException;
use App\Domain\ValueObject\shared\IntValueObject;
use App\Domain\ValueObject\shared\StringValueObject;

class SignersCount extends IntValueObject
{
    public function __construct(array $signers, int $maxSigners)
    {
        $value = $this->calculateCount($signers);
        parent::__construct($value);
    }

    private function calculateCount(array $signers): int
    {
        $total = 0;

        /** @var SignerInterface $signer */
        foreach($signers as $signer) {
            $total += $signer->
        }
    }
}
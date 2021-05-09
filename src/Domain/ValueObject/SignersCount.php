<?php
namespace App\Domain\ValueObject;

use App\Domain\Entity\SignerInterface;
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

    /**
     * @param SignerInterface[] $signers
     * @return int
     */
    private function calculateCount(array $signers): int
    {
        $king = false;
        $total = 0;
        /** @var SignerInterface $signer */
        foreach($signers as $signer) {
            if($signer->key()->value() === 'K') {
                $king = true;
            }
            if(!($king && $signer->key()->value() === 'V')) {
                $total += $signer->amount()->value();
            }
        }

        return $total;
    }
}
<?php
namespace App\Domain\ValueObject;

use App\Domain\Entity\SignerInterface;
use App\Domain\ValueObject\shared\IntValueObject;

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
        $king = $this->hasKing($signers);
        $total = 0;
        /** @var SignerInterface $signer */
        foreach ($signers as $signer) {
            if (!($king && $signer->key()->value() === 'V')) {
                $total += $signer->amount()->value();
            }
        }

        return $total;
    }

    /**
     * @param SignerInterface[] $signers
     * @return bool
     */
    public function hasKing(array $signers) :bool
    {
        foreach ($signers as $signer) {
            if ($signer->key()->value() === 'K') {
                return true;
            }
        }

        return false;
    }
}

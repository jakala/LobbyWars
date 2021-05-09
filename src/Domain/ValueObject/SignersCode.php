<?php
namespace App\Domain\Entity\ValueObject\Contract;

use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\Exception\SignersCodeEmptyException;
use App\Domain\ValueObject\shared\StringValueObject;
use SignerInterface;

class SignersCode extends StringValueObject
{
    public function __construct(array $signers = [], int $maxSigners = 3)
    {
        $this->validate($signers, $maxSigners);
        $value = $this->generateCode($signers);
        parent::__construct($value);
    }

    /**
     * @param array $signers
     * @param int $maxSigners
     * @throws MaxSignersCodeException
     * @throws SignersCodeEmptyException
     */
    private function validate(array $signers, int $maxSigners)
    {
        if(empty($value)) {
            throw new SignersCodeEmptyException('SignersCode cannot be generate by empty signers');
        }

        if(!$this->inRange(count($value), 1, $signers)) {
            throw new MaxSignersCodeException('SignersCode must be between 1 and '.$signers);
        }
    }

    /**
     * @param $value
     * @param $start
     * @param $end
     * @return bool
     */
    private function inRange($value, $start, $end) : bool
    {
        return in_array($value, range($start,$end));
    }

    /**
     * @param array $signers
     * @return string
     */
    private function generateCode(array $signers) : string
    {
        $list = $signers;
        usort($list, function( SignerInterface $a, SignerInterface $b) {
            return ($a->value() <=> $b->value());
        });
        $code = '';
        foreach($list as $signer) {
            $code.=$signer->value();
        }

        return $code;
    }
}
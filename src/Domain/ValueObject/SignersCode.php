<?php
namespace App\Domain\ValueObject;

use App\Domain\Exception\IllegalCharsException;
use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\Exception\SignersCodeEmptyException;
use App\Domain\ValueObject\shared\StringValueObject;

class SignersCode extends StringValueObject
{
    /**
     * SignersCode constructor.
     * @param string $value
     * @param int $maxSigners
     * @throws MaxSignersCodeException
     * @throws SignersCodeEmptyException
     */
    public function __construct(string $value, int $maxSigners = 3)
    {
        $value = strtoupper($value);
        $this->validate($value, $maxSigners);
        parent::__construct($value);
    }

    /**
     * @param $value
     * @param int $maxSigners
     * @throws MaxSignersCodeException
     * @throws SignersCodeEmptyException
     */
    private function validate($value, int $maxSigners)
    {
        if (empty($value)) {
            throw new SignersCodeEmptyException('SignersCode cannot be empty');
        }

        if (!$this->inRange(strlen($value), 1, $maxSigners)) {
            throw new MaxSignersCodeException('SignersCode must be between 1 and '.$maxSigners);
        }

        if ($this->hasIllegalChars($value)) {
            throw new IllegalCharsException('SignersCode only accepts chars (K)ing, (N)otary, (V)alidator, (E)mpty');
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
        return in_array($value, range($start, $end));
    }

    private function hasIllegalChars($value) : bool
    {
        return (strlen($value) !== strspn($value, 'KNVE'));
    }
}

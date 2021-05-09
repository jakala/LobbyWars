<?php
namespace App\Domain\ValueObject;

use App\Domain\Exception\IllegalCharsException;
use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\Exception\SignersCodeEmptyException;
use App\Domain\ValueObject\shared\StringValueObject;

class SignersCode extends StringValueObject
{
    protected CONST DEFAULT_CODES = 'KNV';
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

        if (!$this->hasLength($value, $maxSigners)) {
            throw new MaxSignersCodeException('SignersCode must have '.$maxSigners . ' characters');
        }

        if ($this->hasIllegalChars($value)) {
            throw new IllegalCharsException('SignersCode only accepts chars: '.self::DEFAULT_CODES);
        }
    }

    private function hasLength($value, $maxSigners): bool
    {
        return (strlen($value) === $maxSigners);
    }

    protected function hasIllegalChars($value) : bool
    {
        return (strlen($value) !== strspn($value, self::DEFAULT_CODES));
    }


}

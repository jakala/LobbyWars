<?php
namespace App\Domain\ValueObject;

class SignersCodeWithEmpty extends SignersCode
{
    protected const DEFAULT_CODES = 'KNVE';

    protected function hasIllegalChars($value) : bool
    {
        return (strlen($value) !== strspn($value, self::DEFAULT_CODES));
    }
}

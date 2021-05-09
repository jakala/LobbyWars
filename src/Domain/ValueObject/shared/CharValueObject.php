<?php

namespace App\Domain\ValueObject\shared;

use App\Domain\Exception\CharInvalidException;

class CharValueObject
{
    /** @var string|null  */
    private ?string $value;

    /**
     * CharValueObject constructor.
     * @param string|null $value
     * @throws CharInvalidException
     */
    public function __construct(string $value=null)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @param string|null $value
     * @throws CharInvalidException
     */
    private function validate(string $value = null)
    {
        if (strlen($value) !== 1) {
            throw new CharInvalidException('Value must have only 1 character');
        }
    }

    /**
     * @return string
     */
    public function value() : string
    {
        return $this->value;
    }
}

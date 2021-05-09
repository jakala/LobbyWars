<?php
namespace App\Domain\ValueObject\shared;

use App\Domain\Exception\IntegerIdEmptyException;
use App\Domain\Exception\IntegerIdInvalidException;

class IntegerIdValueObject extends IntValueObject
{
    /**
     * IntegerIdValueObject constructor.
     * @param int|null $value
     * @throws IntegerIdEmptyException
     * @throws IntegerIdInvalidException
     */
    public function __construct(int $value = null)
    {
        $this->validate($value);
        parent::__construct($value);
    }

    /**
     * @param int|null $value
     * @throws IntegerIdEmptyException
     * @throws IntegerIdInvalidException
     */
    private function validate(int $value = null)
    {
        if (empty($value)) {
            throw new IntegerIdEmptyException('Id cannot be Empty');
        }

        if ($value < 1) {
            throw new IntegerIdInvalidException('Invalid value for Id');
        }
    }
}
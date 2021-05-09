<?php
namespace App\Domain\Entity;

use App\Domain\ValueObject\SignerAmount;
use App\Domain\ValueObject\SignerKey;

interface SignerInterface
{
    public function amount(): SignerAmount;
    public function key() : SignerKey;
}

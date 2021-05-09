<?php
namespace App\Domain\Entity;

use App\Domain\Entity\ValueObject\Contract\SignerAmount;
use App\Domain\Entity\ValueObject\Contract\SignerKey;

interface SignerInterface
{
    public function amount(): SignerAmount;
    public function key() : SignerKey;
}
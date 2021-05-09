<?php
namespace App\Application\Command;

use App\Domain\ValueObject\SignersCode;

class HowToWinCommand
{
    /** @var SignersCode $defendant */
    private SignersCode $defendant;

    /** @var SignersCode $plaintiff */
    private SignersCode $plaintiff;

    /**
     * HowToWinCommand constructor.
     * @param SignersCode $defendant
     * @param SignersCode $plaintiff
     */
    public function __construct(SignersCode $defendant, SignersCode $plaintiff)
    {
        $this->defendant = $defendant;
        $this->plaintiff = $plaintiff;
    }

    /**
     * @return SignersCode
     */
    public function getDefendant(): SignersCode
    {
        return $this->defendant;
    }

    /**
     * @return SignersCode
     */
    public function getPlaintiff(): SignersCode
    {
        return $this->plaintiff;
    }

}
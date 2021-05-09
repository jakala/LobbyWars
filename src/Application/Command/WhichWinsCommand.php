<?php
namespace App\Application\Command;

use App\Domain\ValueObject\SignersCode;

class WhichWinsCommand
{
    /** @var SignersCode $plaintiff */
    private SignersCode $plaintiff;

    /** @var SignersCode $defendant */
    private SignersCode $defendant;

    /**
     * WhichWinsCommand constructor.
     * @param SignersCode $plaintiff
     * @param SignersCode $defendant
     */
    public function __construct(SignersCode $plaintiff, SignersCode $defendant)
    {
        $this->plaintiff = $plaintiff;
        $this->defendant = $defendant;
    }

    /**
     * @return SignersCode
     */
    public function getPlaintiff(): SignersCode
    {
        return $this->plaintiff;
    }

    /**
     * @return SignersCode
     */
    public function getDefendant(): SignersCode
    {
        return $this->defendant;
    }
}

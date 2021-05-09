<?php
namespace App\Domain\Entity;

use App\Domain\Entity\ValueObject\Contract\ContractId;

class Contract
{
    /** @var ContractId $id */
    private ContractId $id;

    /** @var Faction $plaintiff */
    private Faction $plaintiff;

    /** @var Faction $defendant */
    private Faction $defendant;

    public function __construct(ContractId $id, Faction $plaintiff, Faction $defendant)
    {
        $this->id = $id;
        $this->plaintiff = $plaintiff;
        $this->defendant = $defendant;
    }

    /**
     * @return ContractId
     */
    public function getId(): ContractId
    {
        return $this->id;
    }

    /**
     * @return Faction
     */
    public function getPlaintiff(): Faction
    {
        return $this->plaintiff;
    }

    /**
     * @return Faction
     */
    public function getDefendant(): Faction
    {
        return $this->defendant;
    }
}
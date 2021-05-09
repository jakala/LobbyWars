<?php
namespace App\Application\Response;

use App\Domain\ValueObject\SignersCode;
use App\Domain\ValueObject\Winner;

class WinnerResponse implements \JsonSerializable
{
    private SignersCode $plaintiff;
    private SignersCode $defendant;
    private Winner $winner;

    /**
     * WinnerResponse constructor.
     * @param SignersCode $plaintiff
     * @param SignersCode $defendant
     * @param Winner $winner
     */
    public function __construct(SignersCode $plaintiff, SignersCode $defendant, Winner $winner)
    {
        $this->plaintiff = $plaintiff;
        $this->defendant = $defendant;
        $this->winner = $winner;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'plaintiff' => $this->plaintiff->value(),
            'defendant' => $this->defendant->value(),
            'winner' => $this->winner->value()
        ];
    }
}
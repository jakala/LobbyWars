<?php
namespace App\Application\Response;

use App\Domain\ValueObject\SignersCode;
use App\Domain\ValueObject\WinnerKey;

class HowToWinResponse implements \JsonSerializable
{
    private SignersCode $plaintiff;
    private SignersCode $defendant;
    private WinnerKey $winnerKey;

    /**
     * WinnerResponse constructor.
     * @param SignersCode $plaintiff
     * @param SignersCode $defendant
     * @param WinnerKey $winnerKey
     */
    public function __construct(SignersCode $plaintiff, SignersCode $defendant, WinnerKey $winnerKey)
    {
        $this->plaintiff = $plaintiff;
        $this->defendant = $defendant;
        $this->winnerKey = $winnerKey;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $winner = $this->winnerKey->value();
        if($winner === 'E') {
            $winner = "Always win";
        }
        return [
            'defendant' => $this->defendant->value(),
            'plaintiff' => $this->plaintiff->value(),
            'winnerKey' => $winner
        ];
    }
}

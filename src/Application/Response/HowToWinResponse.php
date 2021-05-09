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
    public function __construct(SignersCode $defendant, SignersCode $plaintiff, WinnerKey $winnerKey)
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
        if($winner === 'W') {
            $winner = 'Always win';
        }
        if($winner === 'D') {
            $winner = 'Always drop';
        }
        return [
            'defendant' => $this->defendant->value(),
            'plaintiff' => $this->plaintiff->value(),
            'winnerKey' => $winner
        ];
    }
}

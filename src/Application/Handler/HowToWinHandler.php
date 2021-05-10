<?php
namespace App\Application\Handler;

use App\Application\Command\HowToWinCommand;
use App\Application\Response\HowToWinResponse;
use App\Domain\Entity\EmptySigner;
use App\Domain\Entity\faction;
use App\Domain\Entity\KingSigner;
use App\Domain\Entity\NotarySigner;
use App\Domain\Entity\ValidatorSigner;
use App\Domain\ValueObject\RandomFactionId;
use App\Domain\ValueObject\RandomSignerId;
use App\Domain\ValueObject\SignersCode;
use App\Domain\ValueObject\WinnerKey;

class HowToWinHandler
{
    public function howToWin(HowToWinCommand $command) : HowToWinResponse
    {
        $defendantFaction = $this->generateFaction($command->getDefendant());
        $plaintiffFaction = $this->generateFaction($command->getPlaintiff());

        $howToWin = $this->checkHowToWin($defendantFaction, $plaintiffFaction);

        return new HowToWinResponse($command->getDefendant(), $command->getPlaintiff(), $howToWin);
    }

    private function generateFaction(SignersCode $code): Faction
    {
        $faction = new Faction(new RandomFactionId());
        $list = str_split($code->value());
        foreach ($list as $key) {
            $signer = match ($key) {
                'K' => new KingSigner(new RandomSignerId()),
                'N' => new NotarySigner(new RandomSignerId()),
                'V' => new ValidatorSigner(new RandomSignerId()),
                'E' => new EmptySigner(new RandomFactionId()),
            };
            $faction->addSigner($signer);
        }

        return $faction;
    }

    private function checkHowToWin(faction $defendantFaction, faction $plaintiffFaction) : WinnerKey
    {
        $goal = $plaintiffFaction->getSignersCount()->value();
        $actual = $defendantFaction->getSignersCount()->value();

        $winDiff = $defendantFaction->hasKing() ? 2 : 1; // if has king needs 2, cannot use V
        $need = ($goal - $actual) + $winDiff; // +1 to win

        $win = match ($need) {
            -5, -4, -3, -2, -1, 0 => 'W',
            1 => 'V',
            2 => 'N',
            3, 4, 5, 6 => 'K',
            default => 'D',
        };

        return new WinnerKey($win);
    }
}

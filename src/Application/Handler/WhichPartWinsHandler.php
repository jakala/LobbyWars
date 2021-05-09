<?php
namespace App\Application\Handler;

use App\Application\Command\WhichWinsCommand;
use App\Application\Response\WinnerResponse;
use App\Domain\Entity\faction;
use App\Domain\Entity\KingSigner;
use App\Domain\Entity\NotarySigner;
use App\Domain\Entity\ValidatorSigner;
use App\Domain\ValueObject\RandomFactionId;
use App\Domain\ValueObject\RandomSignerId;
use App\Domain\ValueObject\SignersCode;
use App\Domain\ValueObject\Winner;

class WhichPartWinsHandler
{
    public function whichPartWins(WhichWinsCommand $command) : WinnerResponse
    {
        $plaintiffFaction = $this->generateFaction($command->getPlaintiff());
        $defendantFaction = $this->generateFaction($command->getDefendant());

        $winner = $this->lawsuit($plaintiffFaction, $defendantFaction);

        return new WinnerResponse($command->getPlaintiff(),$command->getDefendant(), $winner);
    }

    private function generateFaction(SignersCode $code): Faction
    {
        $faction = new Faction(new RandomFactionId());
        $list = str_split($code->value());
        foreach($list as $key) {
            switch($key) {
                case 'K': $signer = new KingSigner(new RandomSignerId()); break;
                case 'N': $signer = new NotarySigner(new RandomSignerId()); break;
                case 'V': $signer = new ValidatorSigner(new RandomSignerId()); break;
            }
            $faction->addSigner($signer);
        }

        return $faction;
    }

    private function lawsuit(Faction $plainTiff, Faction $defendant) : Winner
    {
        $check = $plainTiff->getSignersCount() <=> $defendant->getSignersCount();
        switch($check) {
            case 1: $win = 'plaintiff'; break;
            case -1: $win = 'defendant'; break;
            case  0: $win = 'draw'; break;
        }

        return new Winner($win);
    }
}
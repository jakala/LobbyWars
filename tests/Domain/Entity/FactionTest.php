<?php
namespace App\Tests\Domain\Entity;

use App\Domain\Entity\faction;
use App\Domain\Entity\KingSigner;
use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\ValueObject\RandomFactionId;
use App\Domain\ValueObject\RandomSignerId;
use PHPUnit\Framework\TestCase;

class FactionTest extends TestCase
{
    /** @test */
    public function should_throw_max_signes_code_exception(): void
    {
        $this->expectException(MaxSignersCodeException::class);

        $id = new RandomFactionId();
        $faction = new Faction($id);

        for($i=0; $i<4; $i++) {
            $signer = new KingSigner(new RandomSignerId());
            $faction->addSigner($signer);
        }
    }

    /** @test */
    public function check_get_id_method() : void
    {
        $id = new RandomFactionId();
        $faction = new Faction($id);

        $this->assertInstanceOf(RandomFactionId::class, $faction->getId());
        $this->assertEquals($id, $faction->getId());
    }
}
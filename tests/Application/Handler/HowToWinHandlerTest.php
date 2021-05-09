<?php
namespace App\Tests\Application\Handler;

use App\Application\Command\HowToWinCommand;
use App\Application\Handler\HowToWinHandler;
use App\Application\Response\HowToWinResponse;
use App\Domain\ValueObject\SignersCodeWithEmpty;
use PHPUnit\Framework\TestCase;

class HowToWinHandlerTest extends TestCase
{
    public function howToWin() : array
    {
        return [
            ['KKE', 'VVV', 'Always win'],
            ['VVE', 'KKK', 'Always drop'],
            ['NVE', 'VVV', 'V'],
            ['NNE', 'KVV', 'N'],
            ['VNE', 'KNV', 'K']
        ];
    }

    /**
     * @throws \App\Domain\Exception\MaxSignersCodeException
     * @throws \App\Domain\Exception\SignersCodeEmptyException
     * @test
     * @dataProvider howToWin
     */
    public function should_return_a_valid_how_to_win_response($defendant, $plaintiff, $result): void
    {
        $handler = new HowToWinHandler();
        $command = new HowToWinCommand(
            new SignersCodeWithEmpty($defendant),
            new SignersCodeWithEmpty($plaintiff)
        );

        $response = $handler->howToWin($command);

        $this->assertInstanceOf(HowToWinResponse::class, $response);
        $decode = json_decode(json_encode($response), true);
        $this->assertEquals($decode['winnerKey'], $result);
    }
}
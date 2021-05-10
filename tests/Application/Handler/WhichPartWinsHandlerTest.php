<?php
namespace App\Tests\Application\Handler;

use App\Application\Command\WhichWinsCommand;
use App\Application\Handler\WhichPartWinsHandler;
use App\Application\Response\WinnerResponse;
use App\Domain\ValueObject\SignersCode;
use PHPUnit\Framework\TestCase;

class WhichPartWinsHandlerTest extends TestCase
{
    public function winnerCases() : array
    {
        return [
            ['KKK', 'VVV', 'plaintiff'],
            ['VVV', 'KKK', 'defendant'],
            ['NNV', 'KVV', 'draw'],
        ];
    }

    /**
     * @throws \App\Domain\Exception\MaxSignersCodeException
     * @throws \App\Domain\Exception\SignersCodeEmptyException
     * @test
     * @dataProvider winnerCases
     */
    public function should_return_winner_response($plaintiff, $defendant, $winner): void
    {
        $handler = new WhichPartWinsHandler();
        $command = new WhichWinsCommand(
            new SignersCode($plaintiff),
            new SignersCode($defendant)
        );

        $response = $handler->whichPartWins($command);
        $this->assertInstanceOf(WinnerResponse::class, $response);
        $decode = json_decode(json_encode($response), true);
        $this->assertEquals($decode['winner'], $winner);
    }
}

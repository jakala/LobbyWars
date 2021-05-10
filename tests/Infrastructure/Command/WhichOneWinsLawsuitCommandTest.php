<?php
namespace App\Tests\Infrastructure\Command;

use App\Application\Handler\HowToWinHandler;
use App\Application\Handler\WhichPartWinsHandler;
use App\Domain\Exception\IllegalCharsException;
use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\Exception\SignersCodeEmptyException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WhichOneWinsLawsuitCommandTest extends TestCase
{
    /** @test */
    public function should_call_configure_method() : void
    {
        $handler = $this->getHandler();
        $command = new WhichOneWinsLawsuitCommandStub($handler);
        $command->configure();
    }

    /** @test */
    public function should_call_execute_method() : void
    {
        $handler = $this->getHandler();
        $handler->method('whichPartWins');
        $command = new WhichOneWinsLawsuitCommandStub($handler);
        $plaintiff = 'KKV';
        $defendant = 'KKK';

        $output = $this->createMock(OutputInterface::class);
        $input = $this->createMock(InputInterface::class);
        $input
            ->method('getArgument')
            ->willReturn($plaintiff);
        $input
            ->method('getArgument')
            ->willReturn($defendant);

        $command->execute($input, $output);
    }

    public function getExceptions(): array
    {
        return [
            [new SignersCodeEmptyException()],
            [new MaxSignersCodeException()],
            [new IllegalCharsException()],
        ];
    }

    /**
     * @param $throws
     * @dataProvider getExceptions
     * @test
     */
    public function should_catch_some_exceptions($throws) : void
    {
        $handler = $this->getHandler();
        $handler
            ->method('whichPartWins')
            ->willThrowException($throws);

        $command = new WhichOneWinsLawsuitCommandStub($handler);
        $plaintiff = 'KKV';
        $defendant = 'KKK';

        $output = $this->createMock(OutputInterface::class);
        $input = $this->createMock(InputInterface::class);
        $input
            ->method('getArgument')
            ->willReturn($plaintiff);
        $input
            ->method('getArgument')
            ->willReturn($defendant);

        $result = $command->execute($input, $output);
        $this->assertEquals(HowToWinLawsuitCommandStub::FAILURE, $result);
    }


    private function getHandler() : MockObject
    {
        return $this->createMock(WhichPartWinsHandler::class);
    }
}

<?php

namespace App\test\Infrastructure\Controller;

use App\Application\Handler\HowToWinHandler;
use App\Application\Handler\WhichPartWinsHandler;
use App\Domain\Exception\IllegalCharsException;
use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\Exception\SignersCodeEmptyException;
use App\Infrastructure\Controller\HowToWinController;
use App\Infrastructure\Controller\WhichOneWinsController;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class WhichOneWinsControllerTest extends TestCase
{
    /** @test */
    public function should_call_handler_and_return_a_json_response() : void
    {
        $handler = $this->getHandler();
        $handler->method('whichPartWins');

        $controller = new WhichOneWinsController($handler);

        $plaintiff = 'KKV';
        $defendant = 'KKK';
        $controller->__invoke($plaintiff, $defendant);
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
    public function should_throw_bad_request_exception_from_some_exceptions($throws): void
    {
        $this->expectException(BadRequestException::class);
        $handler = $this->getHandler();
        $handler
            ->method('whichPartWins')
            ->willThrowException($throws)
        ;

        $controller = new WhichOneWinsController($handler);

        $plaintiff = 'KKV';
        $defendant = 'KKK';
        $controller->__invoke($plaintiff, $defendant);
    }

    private function getHandler() : MockObject
    {
        return $this->createMock(WhichPartWinsHandler::class);
    }
}

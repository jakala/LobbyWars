<?php
namespace App\Infrastructure\Controller;

use App\Application\Command\HowToWinCommand;
use App\Application\Handler\HowToWinHandler;
use App\Domain\Exception\IllegalCharsException;
use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\Exception\SignersCodeEmptyException;
use App\Domain\ValueObject\SignersCode;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;

class HowToWinController
{
    private HowToWinHandler $handler;

    public function __construct(HowToWinHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(string $defendant, string $plaintiff): JsonResponse
    {
        try {
            $command = new HowToWinCommand(
                new SignersCode($defendant, 3),
                new SignersCode($plaintiff, 3)
            );

            $response = $this->handler->howToWin($command);

            return new JsonResponse($response);
        } catch(SignersCodeEmptyException|MaxSignersCodeException|IllegalCharsException $e ) {
            throw new BadRequestException($e->getMessage());
        }
    }
}
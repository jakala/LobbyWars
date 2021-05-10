<?php
namespace App\Infrastructure\Controller;

use App\Application\Command\WhichWinsCommand;
use App\Application\Handler\WhichPartWinsHandler;
use App\Domain\Exception\IllegalCharsException;
use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\Exception\SignersCodeEmptyException;
use App\Domain\ValueObject\SignersCode;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;

class WhichOneWinsController
{
    /** @var WhichPartWinsHandler $handler */
    private WhichPartWinsHandler $handler;

    public function __construct(WhichPartWinsHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(string $plaintiff, string $defendant) : JsonResponse
    {
        try {
            $command = new WhichWinsCommand(new SignersCode($plaintiff, 3), new SignersCode($defendant, 3));
            $response = $this->handler->whichPartWins($command);

            return new JsonResponse($response);
        } catch (SignersCodeEmptyException|MaxSignersCodeException|IllegalCharsException $e) {
            throw new BadRequestException($e->getMessage());
        }
    }
}

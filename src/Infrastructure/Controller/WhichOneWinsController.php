<?php
namespace App\Infrastructure\Controller;

use App\Application\Command\WhichWinsCommand;
use App\Application\Handler\WhichPartWinsHandler;
use App\Domain\ValueObject\SignersCode;
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
        $command = new WhichWinsCommand(new SignersCode($plaintiff, 3), new SignersCode($defendant, 3));
        $response = $this->handler->whichPartWins($command);

        return new JsonResponse($response);
    }
}

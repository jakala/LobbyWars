<?php
namespace App\Infrastructure\Command;

use App\Application\Command\HowToWinCommand;
use App\Application\Command\WhichWinsCommand;
use App\Application\Handler\HowToWinHandler;
use App\Application\Handler\WhichPartWinsHandler;
use App\Domain\Exception\IllegalCharsException;
use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\Exception\SignersCodeEmptyException;
use App\Domain\ValueObject\SignersCode;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WhichOneWinsLawsuitCommand extends Command
{
    protected static $defaultName = 'lawsuit:winner';

    /** @var WhichPartWinsHandler $handler */
    protected WhichPartWinsHandler $handler;

    public function __construct(WhichPartWinsHandler $handler)
    {
        $this->handler = $handler;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('checks what faction wins the lawsuit, based on signature code comparison');
        $this->setDefinition(
            new InputDefinition([
                new InputArgument('plaintiff', InputArgument::REQUIRED, 'signature code for plaintiff faction'),
                new InputArgument('defendant', InputArgument::REQUIRED, 'signature code for defendant faction'),
            ])
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $plaintiff = $input->getArgument('plaintiff');
        $defendant = $input->getArgument('defendant');

        try {
            $command = new WhichWinsCommand(new SignersCode($plaintiff, 3), new SignersCode($defendant, 3));
            $result = $this->handler->whichPartWins($command);
            $response = json_encode($result, true);
            $output->writeln($response);
        } catch(SignersCodeEmptyException|MaxSignersCodeException|IllegalCharsException $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }

}
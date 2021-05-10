<?php
namespace App\Infrastructure\Command;

use App\Application\Command\HowToWinCommand;
use App\Application\Handler\HowToWinHandler;
use App\Domain\Exception\IllegalCharsException;
use App\Domain\Exception\MaxSignersCodeException;
use App\Domain\Exception\SignersCodeEmptyException;
use App\Domain\ValueObject\SignersCodeWithEmpty;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HowToWinLawsuitCommand extends Command
{
    protected static $defaultName = 'lawsuit:how-to-win';

    /** @var HowToWinHandler $handler */
    protected HowToWinHandler $handler;

    public function __construct(HowToWinHandler $handler)
    {
        $this->handler = $handler;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('checks what faction wins the lawsuit, based on signature code comparison');
        $this->setDefinition(
            new InputDefinition([
                new InputArgument('defendant', InputArgument::REQUIRED, 'signature code for defendant faction'),
                new InputArgument('plaintiff', InputArgument::REQUIRED, 'signature code for plaintiff faction'),
            ])
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $plaintiff = $input->getArgument('plaintiff');
        $defendant = $input->getArgument('defendant');

        try {
            $command = new HowToWinCommand(new SignersCodeWithEmpty($defendant, 3), new SignersCodeWithEmpty($plaintiff, 3));
            $result = $this->handler->howToWin($command);
            $response = json_encode($result, true);
            $output->writeln($response);
        } catch (SignersCodeEmptyException|MaxSignersCodeException|IllegalCharsException $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }
}

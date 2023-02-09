<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'saludaCommand',
    description: 'Add a short description for your command',
)]
class SaludaCommand extends Command
{

    protected static $defaultName = 'saludaCommand';

    protected function configure(): void
    {
        $this
            ->setDescription('Un comando que saluda, ya  está')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('Buenas : %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('Gato con botas 2 > Avatar 2');

        return Command::SUCCESS;
    }
}

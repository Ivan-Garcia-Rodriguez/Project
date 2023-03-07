<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use App\Service\MailerService;

#[AsCommand(
    name: 'mailerCommand',
    description: 'Comando que manda un email',
)]
class SaludaCommand extends Command
{

    protected static $defaultName = 'saludaCommand';
    private  MailerService $mailer ;
    public function __construct(MailerService $mailer)
    {
        parent::__construct(null);
        $this->mailer = $mailer;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Un comando que manda un email')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

       
        
        $this->mailer->sendEmail('Buenas tardes');
        

        

        return Command::SUCCESS;
    }
}

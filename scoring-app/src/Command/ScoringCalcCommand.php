<?php

namespace App\Command;

use App\Client\Entity\Client;
use PHPUnit\Event\Runtime\PHP;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Client\Repository\ClientRepository;
use App\Scoring\ScoringService;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'app:scoring-calc',
    description: 'Расчёт скоринга клиентов',
)]
class ScoringCalcCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientRepository $clientRepository,
        private ScoringService $scoringService
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('id', InputArgument::OPTIONAL, 'ID Клиента')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $input->getArgument('id');
        $output->writeln('');
        if ($id) {
            $client = $this->clientRepository->find($id);
            if (!$client) {
                $output->writeln("<error>Клиент с ID $id не найден</error>");
                return Command::FAILURE;
            }
            $this->resultScore($client, $output);
        } else {
            $clients = $this->clientRepository->findAll();
            foreach ($clients as $client) {
                $this->resultScore($client, $output);
            }
        }

        return Command::SUCCESS;
    }

    protected function resultScore(Client $client, OutputInterface $output): void
    {
        $output->writeln('<info>Скоринг для клиента: '.$client->getId().' ('.$client->getFirstName().')</info>');

        $result = $this->scoringService->calc($client);
        foreach ($result['detail'] as $detail) {
            $output->writeln($detail);
        }
        $output->writeln('Общий скоринг: '.$result['score'].PHP_EOL);

        $client->setScore($result['score']);

        $this->em->flush();
    }
}

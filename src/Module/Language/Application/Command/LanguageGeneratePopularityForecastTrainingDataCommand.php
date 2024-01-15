<?php

namespace App\Module\Language\Application\Command;

use App\Module\Language\Infrastructure\Query\GetMostPopularQuery;
use App\Module\Language\Infrastructure\Writer\PopularityForecastTrainingDataWriter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:language:generate-popularity-forecast-training-data',
    description: 'Add a short description for your command',
)]
class LanguageGeneratePopularityForecastTrainingDataCommand extends Command
{
    public function __construct(
        private readonly GetMostPopularQuery $getMostPopularQuery,
        private readonly PopularityForecastTrainingDataWriter $popularityForecastTrainingDataWriter
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $mostPopular = $this->getMostPopularQuery->getMostPopular();
        $path = $this->popularityForecastTrainingDataWriter->writeTrainingData($mostPopular);

        $io->success("File generated: $path");

        return Command::SUCCESS;
    }
}

<?php

namespace App\Command;

use App\Services\ConvertCsvService;
use SimpleXMLElement;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'app:convert-csv',
    description: 'CLI command to convert the input CSV file to a JSON and XML file.',
)]
class ConvertCsvCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Please provide file name:')
            ->addOption('option1', null, InputOption::VALUE_REQUIRED, 'Please provide file name.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("CSV File Converter (Csv file should be placed under \'public\' folder)");

        //Validate entered file
        $provide_file = $this->validateFile($io);

        //Process CSV file & prepare JSON for return
        $convertCsv = new ConvertCsvService();
        $json_response = $convertCsv->processFile($provide_file);

        //Process XML
        $json_input = json_decode ($json_response, true);
        $xml = new SimpleXMLElement('<root/>');
        $convertCsv->arrayToXml($json_input, $xml);
        $p_xml = $xml->asXML();

        //Write XML to file
        //dump($xml);
        $path = dirname(__DIR__) . '/Data/data'.date('Ymdhis', mktime(0, 0, 0, 7, 1, 2000)).'.xml';
        $fileSystem = new Filesystem();
        $fileSystem->dumpFile($path, $p_xml);

        //Return Json
        return dd($json_response);
    }

    protected function validateFile(SymfonyStyle $io): string
    {
        $provide_file = $io->ask("Please provide file name");
        while($provide_file == '')
        {
            $io->writeln(
                'File Name should not be blank');
            $provide_file = $io->ask('Please provide file name');
        }

        while(!str_contains($provide_file, '.csv'))
        {
            $io->writeln(
                'Please provide a .csv file');
            $provide_file = $io->ask('Please provide file name');
        }

        return $provide_file;
    }
}

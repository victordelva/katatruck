<?php


namespace App\Carnovo\Cars\Infrastructure\CLI;


use App\Carnovo\Cars\Application\Request\ImportCarRequest;
use App\Carnovo\Cars\Application\UseCase\ImportCarsUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCarsCommand extends Command
{
    protected static $defaultName = 'app:cars:import';

    private ImportCarsUseCase $useCase;
    private string $filePath;

    public function __construct(
        ImportCarsUseCase $useCase,
        string $path
    ) {
        parent::__construct();
        $this->useCase = $useCase;
        $this->filePath = $path;
    }

    protected function configure(): void
    {
        $this->setDescription('Import cars from file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $nCarsImported = 0;
            if ($file = fopen($this->filePath, "r")) {
                $isHeader = true;
                while(!feof($file)) {
                    $line = fgets($file);
                    if (!$isHeader) {
                        list($nan, $nan, $nan, $fullText) = preg_split("/[\t]/", $line);
                        list($brand, $model) = explode(':', preg_replace("/\r|\n/", "", $fullText));
                        ($this->useCase)(new ImportCarRequest($brand, $model));
                    }
                    $isHeader = false;
                    ++$nCarsImported;
                }
                fclose($file);
            }

            $output->writeln(sprintf('<info>%s cars imported</info>', $nCarsImported));
        } catch (\Exception $exception) {
            dd($exception);
            $output->writeln('<info>Error importing cars</info>');
            return 1;
        }

        return 0;
    }
}
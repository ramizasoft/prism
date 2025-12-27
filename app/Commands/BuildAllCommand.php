<?php

declare(strict_types=1);

namespace Prism\Core\Commands;

use LaravelZero\Framework\Commands\Command;
use Prism\Core\Concerns\IteratesFleet;

use function base_path;
use function trim;

final class BuildAllCommand extends Command
{
    use IteratesFleet;

    protected $signature = 'build:all {--stop-on-failure : Halt on first failed build}'
        . ' {--file=fleet.json : Path to fleet JSON file}';

    protected $description = 'Run prism build for all client repositories in the fleet';

    public function handle(): int
    {
        $stopOnFailure = (bool) $this->option('stop-on-failure');
        $fleetOption = (string) $this->option('file');
        $workingDirectory = getcwd() ?: base_path();

        $fleet = $this->loadFleet($fleetOption, $workingDirectory);

        if (isset($fleet['error'])) {
            $this->error($fleet['error']);

            return self::FAILURE;
        }

        $sites = $fleet['paths'];
        $progress = $this->output->createProgressBar(count($sites));
        $progress->setFormat('verbose');
        $progress->start();

        $result = $this->processFleet(
            $sites,
            function (string $site) use ($stopOnFailure): array {
                $command = [
                    PHP_BINARY,
                    $site . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'prism',
                    'build',
                    'production',
                ];

                $processResult = $this->runProcess($command, $site);

                if ($processResult['status'] === 'Failure') {
                    return [
                        'site' => $site,
                        'status' => 'Failure',
                        'message' => trim($processResult['message']),
                    ];
                }

                return [
                    'site' => $site,
                    'status' => 'Success',
                    'message' => '',
                ];
            },
            $progress,
            $stopOnFailure
        );

        $progress->finish();
        $this->newLine(2);

        $this->table(['Site', 'Status', 'Message'], array_map(
            fn (array $row) => [$row['site'], $row['status'], $row['message']],
            $result['rows']
        ));

        return $result['failures'] > 0 ? self::FAILURE : self::SUCCESS;
    }
}


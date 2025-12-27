<?php

declare(strict_types=1);

namespace Prism\Core\Commands;

use LaravelZero\Framework\Commands\Command;
use Prism\Core\Concerns\IteratesFleet;

use function base_path;

final class UpdateAllCommand extends Command
{
    use IteratesFleet;

    protected $signature = 'update:all {--dry-run : Simulate without executing commands}'
        . ' {--file=fleet.json : Path to fleet JSON file}'
        . ' {--push : Also git push after updating (default: false)}';

    protected $description = 'Update the Prism engine across all client repositories';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $fleetOption = (string) $this->option('file');
        $push = (bool) $this->option('push');

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
            function (string $site) use ($dryRun, $push): array {
                if ($dryRun) {
                    return ['site' => $site, 'status' => 'Success', 'message' => 'Dry run'];
                }

                return $this->runUpdates($site, $push);
            },
            $progress
        );

        $progress->finish();
        $this->newLine(2);

        $this->table(['Site', 'Status', 'Message'], array_map(
            fn (array $row) => [$row['site'], $row['status'], $row['message']],
            $result['rows']
        ));

        return $result['failures'] > 0 ? self::FAILURE : self::SUCCESS;
    }

    /**
     * @return array{site:string,status:string,message:string}
     */
    private function runUpdates(string $sitePath, bool $push): array
    {
        $commands = [
            ['composer', 'update', 'prism/core-engine'],
            ['git', 'add', 'composer.lock'],
            ['git', 'commit', '-m', 'chore: update prism engine'],
        ];

        if ($push) {
            $commands[] = ['git', 'push'];
        }

        foreach ($commands as $command) {
            $result = $this->runProcess($command, $sitePath);

            if ($result['status'] === 'Failure') {
                return ['site' => $sitePath, 'status' => 'Failure', 'message' => $result['message']];
            }
        }

        return ['site' => $sitePath, 'status' => 'Success', 'message' => $push ? 'Updated and pushed' : 'Updated (push skipped)'];
    }
}


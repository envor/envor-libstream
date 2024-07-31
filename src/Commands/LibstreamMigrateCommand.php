<?php

namespace Envor\Libstream\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Schema;

class LibstreamMigrateCommand extends Command
{
    public $signature = 'libstream:migrate {--force : Run the command without asking for confirmation} {--fresh : Drop all libstream tables and re-run migrations} {--database= : The database connection to use}';

    public $description = 'Run the libstream migrations';

    public function handle(): int
    {
        if ($this->option('database')) {
            app(DatabaseManager::class)->usingConnection($this->option('database'), fn () => $this->body());

            return self::SUCCESS;
        }

        $this->body();

        return self::SUCCESS;
    }

    protected function migrationTables(): array
    {
        return config('libstream.migration_tables', []);
    }

    protected function body()
    {
        if ($this->option('fresh')) {
            foreach ($this->migrationTables() as $table) {
                $this->info("Dropping table: $table");
                Schema::dropIfExists($table);
            }
        }

        $realpath = realpath(__DIR__.'/../../database/migrations/*');

        $options = ['--path' => $realpath, '--realpath' => true];
        if ($this->option('force')) {
            $options['--force'] = true;
        }
        if ($this->option('fresh')) {
            $this->call('migrate:refresh', $options, $this->output);
        }

        $this->call('migrate', $options, $this->output);
    }
}

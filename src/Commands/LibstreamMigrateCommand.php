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
        if($this->option('database')) {
            app(DatabaseManager::class)->usingConnection($this->option('database'), fn() => $this->body());
            return self::SUCCESS;
        }

        $this->body();

        return self::SUCCESS;
    }

    private function body()
    {
        if ($this->option('fresh')) {
            foreach (config('libstream.migration_tables') as $table) {
                Schema::dropIfExists($table);
            }

            // delete the migrations from the migrations repository
            $files = glob(__DIR__ . '/../../database/migrations/*');

            foreach ($files as $file) {
                // get the migration file name without extension
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                //get full realpath to file
                $realpath = realpath($file);
                // delete the migration from the migrations repository
                $options = ['--path' => $realpath, '--realpath' => true];
                if ($this->option('force')) {
                    $options['--force'] = true;
                }
                $this->call('migrate:reset', $options, $this->output);
            }
            return;
        }

        // run the migrations
        $options = ['--path' => __DIR__ . '/../../database/migrations'];
        if ($this->option('force')) {
            $options['--force'] = true;
        }
        $this->call('migrate', $options, $this->output);
    }
}

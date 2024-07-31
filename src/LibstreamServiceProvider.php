<?php

namespace Envor\Libstream;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LibstreamServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('libstream')
            ->hasConfigFile()
            ->hasCommand(Commands\LibstreamMigrateCommand::class)
            ->hasMigrations([
                '2024_06_26_194318_create_stored_events_table',
                '2024_06_26_194319_create_snapshots_table',
                '2024_06_27_165025_change_stored_events_aggregate_uuid_column',
                '2024_07_01_234023_change_snapshots_uuid_column',
                '2024_07_07_131035_create_deleted_models_table',
            ])
            ->runsMigrations();
    }
}

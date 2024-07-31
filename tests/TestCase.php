<?php

namespace Envor\Libstream\Tests;

use Envor\Libstream\LibstreamServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Envor\\Libstream\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LibstreamServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_libstream_table.php.stub';
        $migration->up();
        */
        $migration = include __DIR__.'/../database/migrations/2024_06_26_194318_create_stored_events_table.php';
        $migration->up();
        $migration = include __DIR__.'/../database/migrations/2024_06_26_194319_create_snapshots_table.php';
        $migration->up();
        $migration = include __DIR__.'/../database/migrations/2024_06_27_165025_change_stored_events_aggregate_uuid_column.php';
        $migration->up();
        $migration = include __DIR__.'/../database/migrations/2024_07_01_234023_change_snapshots_uuid_column.php';
        $migration->up();
        $migration = include __DIR__.'/../database/migrations/2024_07_07_131035_create_deleted_models_table.php';
        $migration->up();

    }
}

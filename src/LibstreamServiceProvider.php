<?php

namespace Envor\Libstream;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Envor\Libstream\Commands\LibstreamCommand;

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
            ->hasViews()
            ->hasMigration('create_libstream_table')
            ->hasCommand(LibstreamCommand::class);
    }
}

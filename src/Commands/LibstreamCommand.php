<?php

namespace Envor\Libstream\Commands;

use Illuminate\Console\Command;

class LibstreamCommand extends Command
{
    public $signature = 'libstream';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

<?php

namespace Envor\Libstream\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Envor\Libstream\Libstream
 */
class Libstream extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Envor\Libstream\Libstream::class;
    }
}

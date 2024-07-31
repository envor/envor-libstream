<?php

namespace Envor\Libstream;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored as StoredEventsShouldBeStored;

abstract class ShouldBeStored extends StoredEventsShouldBeStored
{
    public string $aggregateUuid;
}

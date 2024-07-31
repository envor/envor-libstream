<?php

namespace Envor\Libstream;

use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use Spatie\EventSourcing\Commands\AggregateUuid;
use Spatie\EventSourcing\Commands\HandledBy;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

#[HandledBy(AggregateRoot::class)]
interface StorableSignature
{
    public function __construct(
        ShouldBeStored $signature,
        #[AggregateUuid]
        ?string $aggregateUuid = null,
    );

    public function signature(): ShouldBeStored;
}

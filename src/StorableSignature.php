<?php

namespace Envor\Libstream;

use Spatie\EventSourcing\Commands\AggregateUuid;

/** #[HandledBy(AggregateRoot::class)] */
interface StorableSignature
{
    public function __construct(
        ShouldBeStored $signature,
        #[AggregateUuid]
        ?string $aggregateUuid = null,
    );

    public function signature(): ShouldBeStored;
}

<?php

namespace Envor\Libstream;

use Spatie\EventSourcing\Commands\AggregateUuid;

trait HasStorableEventSignature
{
    public function __construct(
        public ShouldBeStored $signature,
        #[AggregateUuid]
        public ?string $aggregateUuid = null,
    ) {
        $this->aggregateUuid = $this->aggregateUuid ?? $signature->aggregateUuid;
    }

    public function signature(): ShouldBeStored
    {
        return $this->signature;
    }
}

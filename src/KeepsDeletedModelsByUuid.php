<?php

namespace Envor\Libstream;

use Illuminate\Database\Eloquent\Model;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

trait KeepsDeletedModelsByUuid
{
    use KeepsDeletedModels;

    public static function bootKeepsDeletedModels(): void
    {
        static::deleted(function (Model $model) {
            if (! $model->shouldKeep) {
                return;
            }

            if (! $model->shouldKeep()) {
                return;
            }

            static::getDeletedModelClassName()::create([
                'key' => $model->uuid ?? $model->getKey(),
                'model' => $model->getMorphClass(),
                'values' => $model->attributesToKeep(),
            ]);
        });
    }
}

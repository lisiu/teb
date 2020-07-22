<?php

namespace App\DateKeys;

use Illuminate\Support\Collection;

class EloquentDateKeysRepository implements DateKeysRepository
{
    private DateKey $model;

    public function __construct(DateKey $model)
    {
        $this->model = $model;
    }

    public function insertMany(array $models): void
    {
        collect($models)->chunk(365)->each(
            function (Collection $chunk) {
                $values = $chunk->toArray();
                $this->model->newQuery()->insertOrIgnore($values);
            }
        );
    }
}

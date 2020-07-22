<?php

namespace App\DateKeys;

use Illuminate\Support\Collection;

/**
 * @todo Introduce repository interface
 */
class DateKeysRepository
{
    private DateKey $model;

    public function __construct(DateKey $model)
    {
        $this->model = $model;
    }

    public function insertMany(array $models)
    {
        collect($models)->chunk(365)->each(
            function (Collection $chunk) {
                $values = $chunk->toArray();
                $this->model->newQuery()->insertOrIgnore($values);
            }
        );
    }
}

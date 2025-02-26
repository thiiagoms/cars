<?php

declare(strict_types=1);

namespace SherifSheremetaj\Cars;

use SherifSheremetaj\Cars\Enums\DataTypes;
use SherifSheremetaj\Cars\Factories\DataLoaderFactory;

class CarTypes
{
    private function datasetPath(): string
    {
        return __DIR__ . '/data/car_types.json';
    }

    public function getTypes(DataTypes $dataTypes): array|string
    {
        $loader = DataLoaderFactory::create($dataTypes);

        return $loader->load($this->datasetPath());
    }
}

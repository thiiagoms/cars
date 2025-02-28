<?php

declare(strict_types=1);

namespace SherifSheremetaj\Cars;

use SherifSheremetaj\Cars\Enums\DataTypes;
use SherifSheremetaj\Cars\Factories\DataLoaderFactory;

class FuelTypes
{
    private function datasetPath(): string
    {
        return __DIR__.'/data/fuel_types.json';
    }

    public function getFuelTypes(DataTypes $dataTypes): array|string
    {
        $loader = DataLoaderFactory::create($dataTypes);

        return $loader->load($this->datasetPath());
    }
}

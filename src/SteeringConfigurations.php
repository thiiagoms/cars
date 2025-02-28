<?php

namespace SherifSheremetaj\Cars;

use SherifSheremetaj\Cars\Enums\DataTypes;
use SherifSheremetaj\Cars\Factories\DataLoaderFactory;

class SteeringConfigurations
{
    private function datasetPath(): string
    {
        return __DIR__.'/data/steering_configurations.json';
    }

    public function getSteeringConfigurations(DataTypes $dataTypes): array|string
    {
        $loader = DataLoaderFactory::create($dataTypes);

        return $loader->load($this->datasetPath());
    }
}

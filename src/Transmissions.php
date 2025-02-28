<?php

namespace SherifSheremetaj\Cars;

use SherifSheremetaj\Cars\Enums\DataTypes;
use SherifSheremetaj\Cars\Factories\DataLoaderFactory;

class Transmissions
{
    private function datasetPath(): string
    {
        return __DIR__.'/data/transmissions.json';
    }

    public function getTransmissions(DataTypes $dataTypes): array|string
    {
        $loader = DataLoaderFactory::create($dataTypes);

        return $loader->load($this->datasetPath());
    }
}

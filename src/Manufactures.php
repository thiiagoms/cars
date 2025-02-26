<?php

declare(strict_types=1);

namespace SherifSheremetaj\Cars;

use SherifSheremetaj\Cars\Enums\DataTypes;
use SherifSheremetaj\Cars\Factories\DataLoaderFactory;

class Manufactures
{
    private function datasetPath(): string
    {
        return __DIR__.'/../resources/data/manufactures.json';
    }

    public function getManufactures(DataTypes $dataTypes): array|string
    {
        $loader = DataLoaderFactory::create($dataTypes);

        return $loader->load($this->datasetPath());
    }
}

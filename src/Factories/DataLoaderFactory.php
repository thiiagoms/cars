<?php

declare(strict_types=1);

namespace SherifSheremetaj\Cars\Factories;

use SherifSheremetaj\Cars\Contracts\DataLoaderInterface;
use SherifSheremetaj\Cars\Enums\DataTypes;
use SherifSheremetaj\Cars\Services\DataLoaders\CSVDataLoaderService;
use SherifSheremetaj\Cars\Services\DataLoaders\JsonDataLoaderService;
use SherifSheremetaj\Cars\Services\DataLoaders\XMLDataLoaderService;

final readonly class DataLoaderFactory
{
    public static function create(DataTypes $dataType): DataLoaderInterface
    {
        return match ($dataType) {
            DataTypes::JSON => new JsonDataLoaderService,
            DataTypes::CSV => new CSVDataLoaderService,
            DataTypes::XML => new XMLDataLoaderService,
        };
    }
}

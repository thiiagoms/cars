<?php

namespace SherifSheremetaj\Cars\Tests\Factories;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\Contracts\DataLoaderInterface;
use SherifSheremetaj\Cars\Enums\DataTypes;
use SherifSheremetaj\Cars\Factories\DataLoaderFactory;
use SherifSheremetaj\Cars\Services\DataLoaders\CSVDataLoaderService;
use SherifSheremetaj\Cars\Services\DataLoaders\JsonDataLoaderService;
use SherifSheremetaj\Cars\Services\DataLoaders\XMLDataLoaderService;

class DataLoaderFactoryTest extends TestCase
{
    public static function dataLoaderProvider(): array
    {
        return [
            ['dataType' => DataTypes::JSON, 'expectedLoader' => new JsonDataLoaderService],
            ['dataType' => DataTypes::CSV,  'expectedLoader' => new CSVDataLoaderService],
            ['dataType' => DataTypes::XML,  'expectedLoader' => new XMLDataLoaderService],
        ];
    }

    #[Test]
    #[DataProvider('dataLoaderProvider')]
    public function itShouldCreateCorrectLoaderOfDataType(DataTypes $dataType, DataLoaderInterface $expectedLoader): void
    {
        $loader = DataLoaderFactory::create($dataType);

        $this->assertEquals($expectedLoader, $loader);
    }
}

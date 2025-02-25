<?php

namespace SherifSheremetaj\Cars\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\Enums\DataTypes;
use SherifSheremetaj\Cars\FuelTypes;

class FuelTypesTest extends TestCase
{
    private FuelTypes $fuelTypes;

    protected function setUp(): void
    {
        $this->fuelTypes = $this->createMock(FuelTypes::class);
    }

    #[Test]
    public function itShouldReturnFuelTypesJsonData(): void
    {
        $expectedJson = '[{
            "type": "Gasoline",
            "description": "A commonly used fuel in internal combustion engines, derived from crude oil.",
            "abbreviation": "Petrol"
        }, {
            "type": "Diesel",
            "description": "A type of fuel made from crude oil, primarily used in diesel engines.",
            "abbreviation": "Diesel"
        }]';

        $this->fuelTypes
            ->expects($this->once())
            ->method('getFuelTypes')
            ->with(DataTypes::JSON)
            ->willReturn($expectedJson);

        $result = $this->fuelTypes->getFuelTypes(DataTypes::JSON);

        $this->assertSame($expectedJson, $result);
    }

    #[Test]
    public function itShouldReturnFuelTypesCSVData(): void
    {
        $expectedCsv = "type,description,abbreviation\nGasoline,A commonly used fuel in internal combustion engines, derived from crude oil.,Petrol\nDiesel,A type of fuel made from crude oil, primarily used in diesel engines.,Diesel\n";

        $this->fuelTypes
            ->expects($this->once())
            ->method('getFuelTypes')
            ->with(DataTypes::CSV)
            ->willReturn($expectedCsv);

        $result = $this->fuelTypes->getFuelTypes(DataTypes::CSV);

        $this->assertSame($expectedCsv, $result);
    }

    #[Test]
    public function itShouldReturnFuelTypesXMLData(): void
    {
        $expectedXml = <<<'XML'
<?xml version="1.0"?>
<fuelTypes>
    <fuelType>
        <type>Gasoline</type>
        <description>A commonly used fuel in internal combustion engines, derived from crude oil.</description>
        <abbreviation>Petrol</abbreviation>
    </fuelType>
    <fuelType>
        <type>Diesel</type>
        <description>A type of fuel made from crude oil, primarily used in diesel engines.</description>
        <abbreviation>Diesel</abbreviation>
    </fuelType>
</fuelTypes>
XML;

        $this->fuelTypes
            ->expects($this->once())
            ->method('getFuelTypes')
            ->with(DataTypes::XML)
            ->willReturn($expectedXml);

        $result = $this->fuelTypes->getFuelTypes(DataTypes::XML);

        $this->assertSame($expectedXml, $result);
    }
}

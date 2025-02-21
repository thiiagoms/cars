<?php namespace SherifSheremetaj\Cars\Tests;

use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\FuelTypes;
use SherifSheremetaj\Cars\DataTypes;

class FuelTypesTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_get_fuel_types_throws_exception_for_invalid_type(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid type provided: jpg");

        $fuelTypes = new FuelTypes();
        $fuelTypes->getFuelTypes("jpg");
    }

    /**
     * @throws Exception
     */
    public function test_get_fuel_types_returns_json_data(): void
    {
        $fuelTypes = $this->createMockForFuelTypes('loadFuelTypesJson');

        $expectedJson = '[{
            "type": "Gasoline",
            "description": "A commonly used fuel in internal combustion engines, derived from crude oil.",
            "abbreviation": "Petrol"
        }, {
            "type": "Diesel",
            "description": "A type of fuel made from crude oil, primarily used in diesel engines.",
            "abbreviation": "Diesel"
        }]';

        $fuelTypes->method('loadFuelTypesJson')->willReturn($expectedJson);

        $result = $fuelTypes->getFuelTypes();

        $this->assertSame($expectedJson, $result);
    }

    /**
     * @throws Exception
     */
    public function test_get_fuel_types_returns_csv_data(): void
    {
        $fuelTypes = $this->createMockForFuelTypes('loadFuelTypesCsv');

        $expectedCsv = "type,description,abbreviation\nGasoline,A commonly used fuel in internal combustion engines, derived from crude oil.,Petrol\nDiesel,A type of fuel made from crude oil, primarily used in diesel engines.,Diesel\n";

        $fuelTypes->method('loadFuelTypesCsv')->willReturn($expectedCsv);

        $result = $fuelTypes->getFuelTypes(DataTypes::CSV);

        $this->assertSame($expectedCsv, $result);
    }

    /**
     * @throws Exception
     */
    public function test_get_fuel_types_returns_xml_data(): void
    {
        $fuelTypes = $this->createMockForFuelTypes('loadFuelTypesXml');

        $expectedXml = <<<XML
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

        $fuelTypes->method('loadFuelTypesXml')->willReturn($expectedXml);

        $result = $fuelTypes->getFuelTypes(DataTypes::XML);

        $this->assertSame($expectedXml, $result);
    }

    /**
     * @throws Exception
     */
    public function test_get_fuel_types_throws_exception_for_unhandled_type(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid type provided: XML");

        $fuelTypes = new FuelTypes();
        $fuelTypes->getFuelTypes("XML");
    }

    public function test_load_fuel_types_json_returns_json_data(): void
    {
        $fuelTypes = $this->createMockForFuelTypes('datasetPath');

        $expectedJson = '[{
            "type": "Gasoline",
            "description": "A commonly used fuel in internal combustion engines, derived from crude oil.",
            "abbreviation": "Petrol"
        }, {
            "type": "Diesel",
            "description": "A type of fuel made from crude oil, primarily used in diesel engines.",
            "abbreviation": "Diesel"
        }]';

        $tempJsonFile = $this->createTempJsonFile($expectedJson);
        $fuelTypes->method('datasetPath')->willReturn($tempJsonFile);

        $result = $fuelTypes->loadFuelTypesJson();

        unlink($tempJsonFile);

        $this->assertSame($expectedJson, $result);
    }

    public function test_load_fuel_types_json_returns_empty_array_on_file_not_found(): void
    {
        $fuelTypes = $this->createMockForFuelTypes('datasetPath');

        $fuelTypes->method('datasetPath')->willReturn('/non/existent/path.json');

        $result = $fuelTypes->loadFuelTypesJson();

        $this->assertSame([], $result);
    }

    public function test_load_fuel_types_csv_returns_valid_csv(): void
    {
        $fuelTypes = $this->createMockForFuelTypes('datasetPath');

        $jsonData = json_encode([
            ['type' => 'Gasoline', 'description' => 'A commonly used fuel', 'abbreviation' => 'Petrol'],
            ['type' => 'Diesel', 'description' => 'Made from crude oil', 'abbreviation' => 'Diesel'],
        ]);

        $tempJsonFile = $this->createTempJsonFile($jsonData);
        $fuelTypes->method('datasetPath')->willReturn($tempJsonFile);

        $csvOutput = $fuelTypes->loadFuelTypesCsv();

        unlink($tempJsonFile);

        $expectedCsv = "type,description,abbreviation\nGasoline,\"A commonly used fuel\",Petrol\nDiesel,\"Made from crude oil\",Diesel\n";
        $this->assertSame($expectedCsv, $csvOutput);
    }

    /**
     * @throws Exception
     */
    public function test_load_fuel_types_xml_returns_valid_xml(): void
    {
        $fuelTypes = $this->createMockForFuelTypes('datasetPath');

        $jsonData = json_encode([
            ['type' => 'Gasoline', 'description' => 'A commonly used fuel', 'abbreviation' => 'Petrol'],
            ['type' => 'Diesel', 'description' => 'Made from crude oil', 'abbreviation' => 'Diesel'],
        ]);

        $tempJsonFile = $this->createTempJsonFile($jsonData);
        $fuelTypes->method('datasetPath')->willReturn($tempJsonFile);

        $xmlOutput = $fuelTypes->loadFuelTypesXml();

        unlink($tempJsonFile);

        $expectedXml = <<<XML
<?xml version="1.0"?>
<fuelTypes>
    <fuelType>
        <type>Gasoline</type>
        <description>A commonly used fuel</description>
        <abbreviation>Petrol</abbreviation>
    </fuelType>
    <fuelType>
        <type>Diesel</type>
        <description>Made from crude oil</description>
        <abbreviation>Diesel</abbreviation>
    </fuelType>
</fuelTypes>
XML;

        $this->assertXmlStringEqualsXmlString($expectedXml, $xmlOutput);
    }

    // Helper Methods

    /**
     * Helper method to create a mock for FuelTypes class with the specified methods.
     *
     * @param string $method
     * @return FuelTypes
     */
    private function createMockForFuelTypes(string $method): FuelTypes
    {
        return $this->getMockBuilder(FuelTypes::class)
            ->onlyMethods([$method])
            ->getMock();
    }

    /**
     * Helper method to create a temporary JSON file with the given data.
     *
     * @param string $jsonData
     * @return string The path to the temporary file.
     */
    private function createTempJsonFile(string $jsonData): string
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'json');
        file_put_contents($tempFile, $jsonData);

        return $tempFile;
    }
}

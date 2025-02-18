<?php

use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\CarTypes;

class CarTypesTest extends TestCase
{
    public function test_get_types_returns_json_data(): void
    {
        $carTypes = $this->getMockBuilder(CarTypes::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $expectedJson = '[{"name":"Sedan","description":"A passenger car with a three-box configuration (engine, passenger, and cargo)."},{"name":"SUV","description":"Sport Utility Vehicle designed for higher ground clearance and off-road capability."}]';

        // Create a temporary file with the expected JSON data.
        $tempJsonFile = tempnam(sys_get_temp_dir(), 'json');
        file_put_contents($tempJsonFile, $expectedJson);

        $carTypes->method('datasetPath')->willReturn($tempJsonFile);

        $result = $carTypes->getTypes();

        unlink($tempJsonFile);

        $this->assertSame($expectedJson, $result);
    }

    public function test_get_types_returns_empty_array_when_file_not_found(): void
    {
        $carTypes = $this->getMockBuilder(CarTypes::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $carTypes->method('datasetPath')->willReturn('/non/existent/path.json');

        $result = $carTypes->getTypes();

        $this->assertSame([], $result);
    }
}

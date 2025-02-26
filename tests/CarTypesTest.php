<?php

namespace SherifSheremetaj\Cars\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\CarTypes;
use SherifSheremetaj\Cars\Enums\DataTypes;

class CarTypesTest extends TestCase
{
    private CarTypes $carTypes;

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    protected function setUp(): void
    {
        $this->carTypes = $this->createMock(CarTypes::class);
    }

    #[Test]
    public function itShouldReturnCarTypesJsonData(): void
    {
        $expectedJson = '[{"name":"Sedan","description":"A passenger car with a three-box configuration (engine, passenger, and cargo)."},{"name":"SUV","description":"Sport Utility Vehicle designed for higher ground clearance and off-road capability."}]';

        $this->carTypes
            ->expects($this->once())
            ->method('getTypes')
            ->with(DataTypes::JSON)
            ->willReturn($expectedJson);

        $result = $this->carTypes->getTypes(DataTypes::JSON);

        $this->assertSame($expectedJson, $result);
    }
}

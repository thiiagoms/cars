<?php

namespace SherifSheremetaj\Cars\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\Enums\DataTypes;
use SherifSheremetaj\Cars\SteeringConfigurations;

class SteeringConfigurationsTest extends TestCase
{
    private SteeringConfigurations $steeringConfigurations;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->steeringConfigurations = $this->createMock(SteeringConfigurations::class);
    }

    #[Test]
    public function itShouldReturnSteeringConfigurationsJsonData(): void
    {
        $expectedJson = '[{"type":"Left-Hand Drive (LHD)","description":"A steering configuration where the steering wheel is positioned on the left side of the vehicle. This is the standard configuration in most countries, where driving occurs on the right side of the road."},{"type":"Right-Hand Drive (RHD)","description":"A steering configuration where the steering wheel is positioned on the right side of the vehicle. This setup is commonly used in countries where driving occurs on the left side of the road, such as the UK, Japan, and Australia."}]';
        $this->steeringConfigurations
            ->expects($this->once())
            ->method('getSteeringConfigurations')
            ->with(DataTypes::JSON)
            ->willReturn($expectedJson);

        $result = $this->steeringConfigurations->getSteeringConfigurations(DataTypes::JSON);

        $this->assertSame($expectedJson, $result);
    }

    #[Test]
    public function itShouldReturnSteeringConfigurationsCSVData(): void
    {
        $expectedCsv = "type,description\nLeft-Hand Drive (LHD),A steering configuration where the steering wheel is positioned on the left side of the vehicle. This is the standard configuration in most countries, where driving occurs on the right side of the road.\nRight-Hand Drive (RHD),A steering configuration where the steering wheel is positioned on the right side of the vehicle. This setup is commonly used in countries where driving occurs on the left side of the road, such as the UK, Japan, and Australia.";

        $this->steeringConfigurations
            ->expects($this->once())
            ->method('getSteeringConfigurations')
            ->with(DataTypes::CSV)
            ->willReturn($expectedCsv);

        $result = $this->steeringConfigurations->getSteeringConfigurations(DataTypes::CSV);

        $this->assertSame($expectedCsv, $result);
    }

    #[Test]
    public function itShouldReturnSteeringConfigurationsXMLData(): void
    {
        $expectedXml = <<<'XML'
<?xml version="1.0"?>
<steeringTypes>
    <steeringType>
        <type>Left-Hand Drive (LHD)</type>
        <description>A steering configuration where the steering wheel is positioned on the left side of the vehicle. This is the standard configuration in most countries, where driving occurs on the right side of the road.</description>
    </steeringType>
    <steeringType>
        <type>Right-Hand Drive (RHD)</type>
        <description>A steering configuration where the steering wheel is positioned on the right side of the vehicle. This setup is commonly used in countries where driving occurs on the left side of the road, such as the UK, Japan, and Australia.</description>
    </steeringType>
</steeringTypes>
XML;

        $this->steeringConfigurations
            ->expects($this->once())
            ->method('getSteeringConfigurations')
            ->with(DataTypes::XML)
            ->willReturn($expectedXml);

        $result = $this->steeringConfigurations->getSteeringConfigurations(DataTypes::XML);

        $this->assertSame($expectedXml, $result);
    }
}

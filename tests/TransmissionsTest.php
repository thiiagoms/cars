<?php

namespace SherifSheremetaj\Cars\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\Enums\DataTypes;
use SherifSheremetaj\Cars\Transmissions;

class TransmissionsTest extends TestCase
{
    private Transmissions $transmissions;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->transmissions = $this->createMock(Transmissions::class);
    }

    #[Test]
    public function itShouldReturnTransmissionsJsonData(): void
    {
        $expectedJson = '[{"type":"Manual","description":"A transmission that requires the driver to manually shift gears using a clutch pedal and gear lever."},{"type":"Automatic","description":"A transmission that automatically changes the vehicle\'s gears as the vehicle moves, without the need for manual shifting."},{"type":"Semi-Automatic","description":"A transmission that combines elements of both manual and automatic transmissions, allowing for manual gear shifting without a clutch pedal."},{"type":"Continuously Variable Transmission (CVT)","description":"A type of automatic transmission that uses a system of pulleys and belts to provide an infinite range of gear ratios, resulting in smoother acceleration."},{"type":"Dual-Clutch Transmission (DCT)","description":"A type of semi-automatic transmission that uses two separate clutches for odd and even gears, offering faster gear shifts."},{"type":"Automated Manual Transmission (AMT)","description":"A type of manual transmission with an automated clutch and shifting mechanism, eliminating the need for a manual clutch pedal."}]';
        $this->transmissions
            ->expects($this->once())
            ->method('getTransmissions')
            ->with(DataTypes::JSON)
            ->willReturn($expectedJson);

        $result = $this->transmissions->getTransmissions(DataTypes::JSON);

        $this->assertSame($expectedJson, $result);
    }

    #[Test]
    public function itShouldReturnTransmissionsCSVData(): void
    {
        $expectedCsv = '[{"type":"Manual","description":"A transmission that requires the driver to manually shift gears using a clutch pedal and gear lever."},{"type":"Automatic","description":"A transmission that automatically changes the vehicle\'s gears as the vehicle moves, without the need for manual shifting."},{"type":"Semi-Automatic","description":"A transmission that combines elements of both manual and automatic transmissions, allowing for manual gear shifting without a clutch pedal."},{"type":"Continuously Variable Transmission (CVT)","description":"A type of automatic transmission that uses a system of pulleys and belts to provide an infinite range of gear ratios, resulting in smoother acceleration."},{"type":"Dual-Clutch Transmission (DCT)","description":"A type of semi-automatic transmission that uses two separate clutches for odd and even gears, offering faster gear shifts."},{"type":"Automated Manual Transmission (AMT)","description":"A type of manual transmission with an automated clutch and shifting mechanism, eliminating the need for a manual clutch pedal."}]';

        $this->transmissions
            ->expects($this->once())
            ->method('getTransmissions')
            ->with(DataTypes::CSV)
            ->willReturn($expectedCsv);

        $result = $this->transmissions->getTransmissions(DataTypes::CSV);

        $this->assertSame($expectedCsv, $result);
    }

    #[Test]
    public function itShouldReturnTransmissionsXMLData(): void
    {
        $expectedXml = <<<'XML'
<?xml version="1.0"?>
<transmissionTypes>
    <transmissionType>
        <type>Manual</type>
        <description>A transmission that requires the driver to manually shift gears using a clutch pedal and gear lever.</description>
    </transmissionType>
    <transmissionType>
        <type>Automatic</type>
        <description>A transmission that automatically changes the vehicle's gears as the vehicle moves, without the need for manual shifting.</description>
    </transmissionType>
    <transmissionType>
        <type>Semi-Automatic</type>
        <description>A transmission that combines elements of both manual and automatic transmissions, allowing for manual gear shifting without a clutch pedal.</description>
    </transmissionType>
    <transmissionType>
        <type>Continuously Variable Transmission (CVT)</type>
        <description>A type of automatic transmission that uses a system of pulleys and belts to provide an infinite range of gear ratios, resulting in smoother acceleration.</description>
    </transmissionType>
    <transmissionType>
        <type>Dual-Clutch Transmission (DCT)</type>
        <description>A type of semi-automatic transmission that uses two separate clutches for odd and even gears, offering faster gear shifts.</description>
    </transmissionType>
    <transmissionType>
        <type>Automated Manual Transmission (AMT)</type>
        <description>A type of manual transmission with an automated clutch and shifting mechanism, eliminating the need for a manual clutch pedal.</description>
    </transmissionType>
</transmissionTypes>
XML;

        $this->transmissions
            ->expects($this->once())
            ->method('getTransmissions')
            ->with(DataTypes::XML)
            ->willReturn($expectedXml);

        $result = $this->transmissions->getTransmissions(DataTypes::XML);

        $this->assertSame($expectedXml, $result);
    }
}

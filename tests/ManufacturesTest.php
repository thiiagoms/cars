<?php

namespace SherifSheremetaj\Cars\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\Enums\DataTypes;
use SherifSheremetaj\Cars\Manufactures;

class ManufacturesTest extends TestCase
{
    private Manufactures $manufactures;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->manufactures = $this->createMock(Manufactures::class);
    }

    #[Test]
    public function itShouldReturnManufacturesJsonData(): void
    {
        $expectedJson = '[{"id":1,"name":"Toyota"},{"id":2,"name":"Ford"}]';

        $this->manufactures
            ->expects($this->once())
            ->method('getManufactures')
            ->with(DataTypes::JSON)
            ->willReturn($expectedJson);

        $result = $this->manufactures->getManufactures(DataTypes::JSON);

        $this->assertSame($expectedJson, $result);
    }

    #[Test]
    public function itShouldReturnManufacturesCSVData(): void
    {
        $expectedCsv = "id,name\n1,Toyota\n2,Ford\n";

        $this->manufactures
            ->expects($this->once())
            ->method('getManufactures')
            ->with(DataTypes::CSV)
            ->willReturn($expectedCsv);

        $result = $this->manufactures->getManufactures(DataTypes::CSV);

        $this->assertSame($expectedCsv, $result);
    }

    #[Test]
    public function itShouldReturnManufacturesXMLData(): void
    {
        $expectedXml = <<<'XML'
<?xml version="1.0"?>
<manufacturers>
    <manufacturer>
        <id>1</id>
        <name>Toyota</name>
    </manufacturer>
    <manufacturer>
        <id>2</id>
        <name>Ford</name>
    </manufacturer>
</manufacturers>
XML;

        $this->manufactures
            ->expects($this->once())
            ->method('getManufactures')
            ->with(DataTypes::XML)
            ->willReturn($expectedXml);

        $result = $this->manufactures->getManufactures(DataTypes::XML);

        $this->assertSame($expectedXml, $result);
    }
}

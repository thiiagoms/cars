<?php

use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\Manufactures;
use SherifSheremetaj\Cars\DataType;

class ManufacturesTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_get_manufactures_throws_exception_for_invalid_type(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid type provided: jpg");

        $manufactures = new Manufactures();
        $manufactures->getManufactures("jpg");
    }

    /**
     * @throws Exception
     */
    public function test_get_manufactures_returns_json_data(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['loadManufacturesJson'])
            ->getMock();

        $expectedJson = '[{"id":1,"name":"Toyota"},{"id":2,"name":"Ford"}]';

        $manufactures->method('loadManufacturesJson')->willReturn($expectedJson);

        $result = $manufactures->getManufactures();

        $this->assertSame($expectedJson, $result);
    }

    /**
     * @throws Exception
     */
    public function test_get_manufactures_returns_csv_data(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['loadManufacturesCsv'])
            ->getMock();

        $expectedCsv = "id,name\n1,Toyota\n2,Ford\n";

        $manufactures->method('loadManufacturesCsv')->willReturn($expectedCsv);

        $result = $manufactures->getManufactures(DataType::CSV);

        $this->assertSame($expectedCsv, $result);
    }

    /**
     * @throws Exception
     */
    public function test_get_manufactures_throws_exception_for_unhandled_type(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid type provided: XML");

        $manufactures = new Manufactures();
        $manufactures->getManufactures("XML");
    }

    public function test_load_manufactures_json_returns_json_data(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $tempJsonFile = tempnam(sys_get_temp_dir(), 'json');
        $expectedJson = '[{"id":1,"name":"Toyota"},{"id":2,"name":"Ford"}]';
        file_put_contents($tempJsonFile, $expectedJson);

        $manufactures->method('datasetPath')->willReturn($tempJsonFile);

        $result = $manufactures->loadManufacturesJson();

        unlink($tempJsonFile);

        $this->assertSame($expectedJson, $result);
    }

    public function test_load_manufactures_json_returns_empty_array_on_file_not_found(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $manufactures->method('datasetPath')->willReturn('/non/existent/path.json');

        $result = $manufactures->loadManufacturesJson();

        $this->assertSame([], $result);
    }

    public function test_load_manufactures_csv_returns_valid_csv(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $jsonData = json_encode([
            ['id' => 1, 'name' => 'Toyota'],
            ['id' => 2, 'name' => 'Ford'],
        ]);

        $tempJsonFile = tempnam(sys_get_temp_dir(), 'json');
        file_put_contents($tempJsonFile, $jsonData);

        $manufactures->method('datasetPath')->willReturn($tempJsonFile);

        $csvOutput = $manufactures->loadManufacturesCsv();

        unlink($tempJsonFile);

        $expectedCsv = "id,name\n1,Toyota\n2,Ford\n";
        $this->assertSame($expectedCsv, $csvOutput);
    }

    public function test_load_manufactures_csv_returns_empty_string_when_file_not_found(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $manufactures->method('datasetPath')->willReturn('/non/existent/path.json');

        $csvOutput = $manufactures->loadManufacturesCsv();

        $this->assertSame('', $csvOutput);
    }

    public function test_load_manufactures_csv_returns_empty_string_for_invalid_json(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $tempJsonFile = tempnam(sys_get_temp_dir(), 'json');
        file_put_contents($tempJsonFile, 'invalid_json');

        $manufactures->method('datasetPath')->willReturn($tempJsonFile);

        $csvOutput = $manufactures->loadManufacturesCsv();

        unlink($tempJsonFile);

        $this->assertSame('', $csvOutput);
    }

    public function test_load_manufactures_csv_returns_empty_string_for_empty_json_array(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $tempJsonFile = tempnam(sys_get_temp_dir(), 'json');
        file_put_contents($tempJsonFile, json_encode([]));

        $manufactures->method('datasetPath')->willReturn($tempJsonFile);

        $csvOutput = $manufactures->loadManufacturesCsv();

        unlink($tempJsonFile);

        $this->assertSame('', $csvOutput);
    }

    /**
     * @throws Exception
     */
    public function test_get_manufactures_returns_xml_data(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['loadManufacturesXml'])
            ->getMock();

        $expectedXml = <<<XML
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

        $manufactures->method('loadManufacturesXml')->willReturn($expectedXml);

        $result = $manufactures->getManufactures(DataType::XML);

        $this->assertSame($expectedXml, $result);
    }

    /**
     * @throws Exception
     */
    public function test_load_manufactures_xml_returns_valid_xml(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $jsonData = json_encode([
            ["name" => "Toyota", "country" => "Japan", "logo" => "/logos/toyota.png"],
            ["name" => "Ford", "country" => "USA", "logo" => "/logos/ford.png"],
        ]);

        $tempJsonFile = tempnam(sys_get_temp_dir(), 'json');
        file_put_contents($tempJsonFile, $jsonData);

        $manufactures->method('datasetPath')->willReturn($tempJsonFile);

        $xmlOutput = $manufactures->loadManufacturesXml();

        unlink($tempJsonFile);

        $expectedXml = <<<XML
<?xml version="1.0"?>
<manufacturers>
    <manufacturer>
        <name>Toyota</name>
        <country>Japan</country>
        <logo>/logos/toyota.png</logo>
    </manufacturer>
    <manufacturer>
        <name>Ford</name>
        <country>USA</country>
        <logo>/logos/ford.png</logo>
    </manufacturer>
</manufacturers>
XML;

        $this->assertXmlStringEqualsXmlString($expectedXml, $xmlOutput);
    }

    /**
     * @throws Exception
     */
    public function test_load_manufactures_xml_returns_empty_string_when_file_not_found(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $manufactures->method('datasetPath')->willReturn('/non/existent/path.json');

        $xmlOutput = $manufactures->loadManufacturesXml();

        $this->assertSame('', $xmlOutput);
    }

    /**
     * @throws Exception
     */
    public function test_load_manufactures_xml_returns_empty_string_for_invalid_json(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $tempJsonFile = tempnam(sys_get_temp_dir(), 'json');
        file_put_contents($tempJsonFile, 'invalid_json');

        $manufactures->method('datasetPath')->willReturn($tempJsonFile);

        $xmlOutput = $manufactures->loadManufacturesXml();

        unlink($tempJsonFile);

        $this->assertSame('', $xmlOutput);
    }

    /**
     * @throws Exception
     */
    public function test_load_manufactures_xml_returns_empty_string_for_empty_json_array(): void
    {
        $manufactures = $this->getMockBuilder(Manufactures::class)
            ->onlyMethods(['datasetPath'])
            ->getMock();

        $tempJsonFile = tempnam(sys_get_temp_dir(), 'json');
        file_put_contents($tempJsonFile, json_encode([]));

        $manufactures->method('datasetPath')->willReturn($tempJsonFile);

        $xmlOutput = $manufactures->loadManufacturesXml();

        unlink($tempJsonFile);

        $this->assertSame('', $xmlOutput);
    }
}

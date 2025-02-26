<?php

namespace SherifSheremetaj\Cars\Tests\Services\DataLoaders;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\Services\DataLoaders\XMLDataLoaderService;

class XMLDataLoaderServiceTest extends TestCase
{
    private string $testFilePath;

    private XMLDataLoaderService $service;

    protected function setUp(): void
    {
        $this->service = new XMLDataLoaderService;
        $this->testFilePath = sys_get_temp_dir().'/test.json';
    }

    #[Test]
    public function itShouldLoadReturnsXmlString(): void
    {
        file_put_contents($this->testFilePath, json_encode([
            ['name' => 'Toyota'],
            ['name' => 'Ford'],
        ]));

        $result = $this->service->load($this->testFilePath);

        $expectedXml = '<?xml version="1.0"?><manufacturers><manufacturer><name>Toyota</name></manufacturer><manufacturer><name>Ford</name></manufacturer></manufacturers>';

        $this->assertIsString($result);
        $this->assertXmlStringEqualsXmlString($expectedXml, $result);
    }

    #[Test]
    public function itShouldLoadReturnsFalseForInvalidFile(): void
    {
        $invalidPath = sys_get_temp_dir().'/non_existent.json';

        $result = $this->service->load($invalidPath);

        $this->assertFalse($result);
    }

    #[Test]
    public function itShouldLoadReturnsFalseForInvalidJson(): void
    {
        file_put_contents($this->testFilePath, 'invalid json');

        $result = $this->service->load($this->testFilePath);

        $this->assertFalse($result);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->testFilePath)) {
            unlink($this->testFilePath);
        }
    }
}

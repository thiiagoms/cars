<?php

namespace SherifSheremetaj\Cars\Tests\Services\DataLoaders;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\Services\DataLoaders\CSVDataLoaderService;

class CSVDataLoaderServiceTest extends TestCase
{
    private string $testFilePath;

    private CSVDataLoaderService $dataLoaderService;

    protected function setUp(): void
    {
        $this->testFilePath = sys_get_temp_dir().'/test.json';

        $this->dataLoaderService = new CSVDataLoaderService;
    }

    public static function csvDataProvider(): array
    {
        return [
            'valid json with data' => [
                'jsonContent' => json_encode([
                    ['name' => 'John', 'age' => 30, 'city' => 'New York'],
                    ['name' => 'Jane', 'age' => 25, 'city' => 'Los Angeles'],
                ]),
                'expectedCsv' => "name,age,city\nJohn,30,\"New York\"\nJane,25,\"Los Angeles\"\n",
            ],
            'empty json file' => [
                'jsonContent' => json_encode([]),
                'expectedCsv' => '',
            ],
            'invalid json file' => [
                'jsonContent' => 'invalid json content',
                'expectedCsv' => '',
            ],
        ];
    }

    #[Test]
    #[DataProvider('csvDataProvider')]
    public function itConvertsJsonToCsvCorrectly(string $jsonContent, string $expectedCsv): void
    {
        file_put_contents($this->testFilePath, $jsonContent);

        $result = $this->dataLoaderService->load($this->testFilePath);

        $this->assertSame($expectedCsv, $result);
    }

    #[Test]
    public function itReturnsEmptyStringIfFileDoesNotExist(): void
    {
        $nonExistentFile = sys_get_temp_dir().'/non_existent.json';

        $result = $this->dataLoaderService->load($nonExistentFile);

        $this->assertSame('', $result);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->testFilePath)) {
            unlink($this->testFilePath);
        }
    }
}

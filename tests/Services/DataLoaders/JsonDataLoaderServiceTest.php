<?php

namespace SherifSheremetaj\Cars\Tests\Services\DataLoaders;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use SherifSheremetaj\Cars\Exceptions\FileNotFoundException;
use SherifSheremetaj\Cars\Services\DataLoaders\JsonDataLoaderService;

class JsonDataLoaderServiceTest extends TestCase
{
    private string $testFilePath;

    private JsonDataLoaderService $dataLoaderService;

    protected function setUp(): void
    {
        $this->testFilePath = sys_get_temp_dir().'/test.json';
        file_put_contents($this->testFilePath, json_encode(['name' => 'John']));

        $this->dataLoaderService = new JsonDataLoaderService;
    }

    #[Test]
    public function itShouldLoadSuccessfullyReturnsFileContents(): void
    {
        $result = $this->dataLoaderService->load($this->testFilePath);

        $this->assertJson($result);
        $this->assertStringContainsString('{"name":"John"}', $result);
    }

    #[Test]
    public function itShouldLoadThrowsExceptionWhenFileNotFound(): void
    {
        $this->expectException(FileNotFoundException::class);
        $this->expectExceptionMessage("file not found: '/invalid/path.json'");

        $this->dataLoaderService->load('/invalid/path.json'); // This path should not exist
    }

    protected function tearDown(): void
    {
        if (file_exists($this->testFilePath)) {
            unlink($this->testFilePath);
        }
    }
}

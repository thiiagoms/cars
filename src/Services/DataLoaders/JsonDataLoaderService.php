<?php

namespace SherifSheremetaj\Cars\Services\DataLoaders;

use SherifSheremetaj\Cars\Contracts\DataLoaderInterface;
use SherifSheremetaj\Cars\Exceptions\FileNotFoundException;

class JsonDataLoaderService implements DataLoaderInterface
{
    public function load(string $path): mixed
    {
        $file = @file_get_contents($path);

        if ($file === false) {
            throw new FileNotFoundException(
                sprintf("file not found: '%s'", $path)
            );
        }

        return $file;
    }
}

<?php

namespace SherifSheremetaj\Cars\Services\DataLoaders;

use SherifSheremetaj\Cars\Contracts\DataLoaderInterface;
use SherifSheremetaj\Cars\helpers\CSVHelper;

class CSVDataLoaderService implements DataLoaderInterface
{
    public function load(string $path): mixed
    {
        return CSVHelper::readAsCSV($path);
    }
}

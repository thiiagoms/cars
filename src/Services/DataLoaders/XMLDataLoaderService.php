<?php

namespace SherifSheremetaj\Cars\Services\DataLoaders;

use SherifSheremetaj\Cars\Contracts\DataLoaderInterface;
use SherifSheremetaj\Cars\helpers\XMLHelper;

class XMLDataLoaderService implements DataLoaderInterface
{
    /**
     * @throws \Exception
     */
    public function load(string $path): mixed
    {
        return XMLHelper::readAsXML(
            path: $path,
            listKey: 'manufacturers',
            key: 'manufacturer'
        );
    }
}

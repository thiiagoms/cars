<?php

declare(strict_types=1);

namespace SherifSheremetaj\Cars\Contracts;

interface DataLoaderInterface
{
    public function load(string $path): mixed;
}

<?php

declare(strict_types=1);

namespace SherifSheremetaj\Cars\Enums;

enum DataTypes: string
{
    case JSON = 'json';
    case CSV = 'csv';
    case XML = 'xml';
}

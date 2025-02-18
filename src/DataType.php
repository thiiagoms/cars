<?php namespace SherifSheremetaj\Cars;

class DataType
{
    public const string JSON = "json";
    public const string CSV= "csv";
    public const string XML= "xml";

    public const array ALL = [
        self::JSON,
        self::CSV,
        self::XML
    ];
}
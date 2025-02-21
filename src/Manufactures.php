<?php namespace SherifSheremetaj\Cars;

use Exception;
use InvalidArgumentException;
use RuntimeException;
use SherifSheremetaj\Cars\helpers\CSVHelper;
use SherifSheremetaj\Cars\helpers\XMLHelper;

class Manufactures
{
    public function datasetPath(): string
    {
        return __DIR__ . '/data/manufactures.json';
    }

    /**
     * @throws Exception
     */
    public function getManufactures(string $type = DataTypes::JSON): array|string
    {
        if (!in_array($type, DataTypes::ALL, true)) {
            throw new InvalidArgumentException("Invalid type provided: $type");
        }

        return match ($type) {
            DataTypes::JSON => $this->loadManufacturesJson(),
            DataTypes::CSV => $this->loadManufacturesCsv(),
            DataTypes::XML => $this->loadManufacturesXml(),
            default => throw new RuntimeException("Unhandled type: $type"),
        };
    }


    public function loadManufacturesJson(): array|string
    {
        $jsonPath = $this->datasetPath();
        $jsonData = file_get_contents($jsonPath);

        if ($jsonData === false) {
            return []; // Handle error case if file reading fails
        }

        return $jsonData;
    }

    public function loadManufacturesCsv(): string
    {
        return CSVHelper::readAsCSV($this->datasetPath());
    }

    /**
     * @throws Exception
     */
    public function loadManufacturesXml(): string
    {
        return XMLHelper::readAsXML($this->datasetPath(), 'manufacturers', 'manufacturer');
    }
}
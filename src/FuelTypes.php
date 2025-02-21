<?php namespace SherifSheremetaj\Cars;

use Exception;
use InvalidArgumentException;
use RuntimeException;
use SherifSheremetaj\Cars\helpers\CSVHelper;
use SherifSheremetaj\Cars\helpers\XMLHelper;

class FuelTypes
{
    public function datasetPath(): string
    {
        return __DIR__ . '/data/fuel_types.json';
    }

    /**
     * @throws Exception
     */
    public function getFuelTypes(string $type = DataTypes::JSON): array|string
    {
        if (!in_array($type, DataTypes::ALL, true)) {
            throw new InvalidArgumentException("Invalid type provided: $type");
        }

        return match ($type) {
            DataTypes::JSON => $this->loadFuelTypesJson(),
            DataTypes::CSV => $this->loadFuelTypesCsv(),
            DataTypes::XML => $this->loadFuelTypesXml(),
            default => throw new RuntimeException("Unhandled type: $type"),
        };
    }

    public function loadFuelTypesJson(): array|string
    {
        $jsonPath = $this->datasetPath();
        $jsonData = file_get_contents($jsonPath);

        if ($jsonData === false) {
            return []; // Handle error case if file reading fails
        }

        return $jsonData;
    }

    public function loadFuelTypesCsv(): string
    {
        return CSVHelper::readAsCSV($this->datasetPath());
    }

    /**
     * @throws Exception
     */
    public function loadFuelTypesXml(): string
    {
        return XMLHelper::readAsXML($this->datasetPath(), 'fuelTypes', 'fuelType');
    }
}
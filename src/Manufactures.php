<?php namespace SherifSheremetaj\Cars;

use InvalidArgumentException;
use RuntimeException;
use SimpleXMLElement;

class Manufactures
{
    public function datasetPath(): string
    {
        return __DIR__ . '/data/manufactures.json';
    }

    public function getManufactures(string $type = DataType::JSON): array|string
    {
        if (!in_array($type, DataType::ALL, true)) {
            throw new InvalidArgumentException("Invalid type provided: $type");
        }

        return match ($type) {
            DataType::JSON => $this->loadManufacturesJson(),
            DataType::CSV => $this->loadManufacturesCsv(),
            DataType::XML => $this->loadManufacturesXml(),
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
        $jsonPath = $this->datasetPath();
        $jsonData = file_get_contents($jsonPath);

        if ($jsonData === false) {
            return ''; // Or handle error as needed
        }

        // Decode JSON into an associative array
        $data = json_decode($jsonData, true);

        if (!is_array($data) || empty($data)) {
            return ''; // No data available
        }

        // Open a temporary memory stream for writing CSV
        $handle = fopen('php://temp', 'r+');
        if ($handle === false) {
            return '';
        }

        // Write header row based on the keys of the first item
        $header = array_keys(reset($data));
        fputcsv($handle, $header);

        // Write each data row to the CSV
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }

        // Rewind the stream and retrieve its content
        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        return $csvContent;
    }

    public function loadManufacturesXml(): string
    {
        $jsonPath = $this->datasetPath();
        $jsonData = file_get_contents($jsonPath);

        if ($jsonData === false) {
            return ''; // Handle error case
        }

        $data = json_decode($jsonData, true);

        if (!is_array($data) || empty($data)) {
            return ''; // Return empty string for invalid data
        }

        // Convert array to XML
        $xml = new SimpleXMLElement('<manufacturers/>');
        foreach ($data as $item) {
            $manufacturer = $xml->addChild('manufacturer');
            foreach ($item as $key => $value) {
                $manufacturer->addChild($key, htmlspecialchars((string)$value));
            }
        }

        return $xml->asXML();
    }
}
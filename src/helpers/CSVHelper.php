<?php namespace SherifSheremetaj\Cars\helpers;

class CSVHelper
{
    public static function readAsCSV(string $path): false|string
    {
        $jsonData = file_get_contents($path);
        if ($jsonData === false) {
            return ''; // Handle error case if file reading fails
        }

        $data = json_decode($jsonData, true);
        if (!is_array($data) || empty($data)) {
            return ''; // No data available
        }

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

        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        return $csvContent;
    }
}
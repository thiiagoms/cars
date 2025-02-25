<?php

namespace SherifSheremetaj\Cars\helpers;

class CSVHelper
{
    public static function readAsCSV(string $path): false|string
    {
        if (! file_exists($path)) {
            return '';
        }

        $jsonData = file_get_contents($path);

        if ($jsonData === false) {
            return '';
        }

        $data = json_decode($jsonData, true);

        if (! is_array($data) || empty($data)) {
            return '';
        }

        $handle = fopen('php://temp', 'r+');
        if ($handle === false) {
            return '';
        }

        $header = array_keys(reset($data));
        fputcsv($handle, $header);

        foreach ($data as $row) {
            fputcsv($handle, $row);
        }

        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        return $csvContent;
    }
}

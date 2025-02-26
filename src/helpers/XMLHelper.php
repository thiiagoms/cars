<?php

namespace SherifSheremetaj\Cars\helpers;

use Exception;
use SimpleXMLElement;

class XMLHelper
{
    /**
     * @throws Exception
     */
    public static function readAsXML(string $path, string $listKey, string $key): bool|string
    {
        if (! file_exists($path) || ! is_readable($path)) {
            return false; // Return false if the file is missing or not readable
        }

        $jsonData = file_get_contents($path);

        if ($jsonData === false) {
            return false; // Handle error case
        }

        $data = json_decode($jsonData, true);

        if (! is_array($data) || empty($data)) {
            return false; // Return false for invalid data
        }

        // Convert array to XML
        $xml = new SimpleXMLElement("<$listKey></$listKey>");

        foreach ($data as $item) {
            if (! is_array($item)) {
                continue; // Skip invalid data
            }

            $elem = $xml->addChild($key);

            foreach ($item as $subKey => $value) {
                $elem->addChild($subKey, htmlspecialchars((string) $value));
            }
        }

        return $xml->asXML();
    }
}

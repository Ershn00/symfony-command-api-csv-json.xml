<?php

namespace App\Services;

use SimpleXMLElement;

class ConvertCsvService
{
    public function processFile($provided_file): string
    {
        //$f = fopen('http://127.0.0.1:8000/data.csv', 'r');
        $f = fopen($provided_file, 'r');
        $header = fgetcsv($f,"1024",",");
        $json_response = array();
        while ($row = fgetcsv($f,"1024",",")) {
            $json_response[] = array_combine($header, $row);
        }
        fclose($f);

        return json_encode($json_response);
    }

    /**
     * Convert an array to XML (Taken from stackoverflow)
     * @param array $array
     * @param SimpleXMLElement $xml
     */
    public function arrayToXml($array, &$xml)
    {
        foreach ($array as $key => $value) {
            if(is_int($key)){
                $key = "e";
            }
            if(is_array($value)){
                $label = $xml->addChild($key);
                $this->arrayToXml($value, $label);
            }
            else {
                $xml->addChild($key, $value);
            }
        }
    }
}
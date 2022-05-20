<?php

namespace App\Controller;

use App\Services\ConvertCsvService;
use SimpleXMLElement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConvertCsvController extends AbstractController
{
    #[Route('/convert/csv/{file_name}', name: 'data_convert_csv', methods: 'GET')]
    public function index(string $file_name): Response
    {
        //Process CSV file & return JSON
        $convertCsv = new ConvertCsvService();
        $json_response = $convertCsv->processFile($file_name);

        //Return XML
        $json_input = json_decode ($json_response, true);
        $xml = new SimpleXMLElement('<root/>');
        $convertCsv->arrayToXml($json_input, $xml);
        print $xml->asXML();

        //Return Json
        $response = new Response($json_response);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    #[Route('/convert/csv/{file_name}/filter/name/{name}', name: 'data_convert_csv_filter_by_name', methods: 'GET')]
    public function filterByName(string $file_name, $name): Response
    {
        //Process CSV file & return JSON
        $convertCsv = new ConvertCsvService();
        $json_response = $convertCsv->processFile($file_name);

        //Filter json response if any filter (name or discount_percentage) is provided
        $json_serialize = json_decode ($json_response, true);
        $filtered_results = [];
        foreach ($json_serialize as $r) {
            if (str_contains(strtolower($r['name']), strtolower($name))) {
                $filtered_results[] = $r;
            }
        }
        $filtered_results = json_encode($filtered_results);

        //Return XML
        $json_input = json_decode ($filtered_results, true);
        $xml = new SimpleXMLElement('<root/>');
        $convertCsv->arrayToXml($json_input, $xml);
        print $xml->asXML();

        //Return Json
        $response = new Response($filtered_results);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    #[Route('/convert/csv/{file_name}/filter/discount/{discount_percentage}', name: 'data_convert_csv_filter_by_discount_percentage', methods: 'GET')]
    public function filterByDiscountPercentage(string $file_name, int $discount_percentage): Response
    {
        //Process CSV file & return JSON
        $convertCsv = new ConvertCsvService();
        $json_response = $convertCsv->processFile($file_name);

        //Filter json response if any filter (name or discount_percentage) is provided
        $json_serialize = json_decode ($json_response, true);
        $filtered_results = [];
        foreach ($json_serialize as $r) {
            if($r['discount_percentage'] == $discount_percentage) {
                $filtered_results[] = $r;
            }
        }
        $filtered_results = json_encode($filtered_results);

        //Return XML
        $json_input = json_decode ($filtered_results, true);
        $xml = new SimpleXMLElement('<root/>');
        $convertCsv->arrayToXml($json_input, $xml);
        print $xml->asXML();

        //Return Json
        $response = new Response($filtered_results);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

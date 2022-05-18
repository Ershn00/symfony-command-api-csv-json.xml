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

        $response = new Response($json_response);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

<?php

namespace App\Tests\Controller;

use App\Controller\ConvertCsvController;
use App\Services\ConvertCsvService;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertCsvControllerTest extends TestCase
{
    public function testApiEndpoints()
    {
        $convertCsv = new ConvertCsvService();
        $json_response = $convertCsv->processFile("http://127.0.0.1:8000/data.csv");
        $json_serialize = json_decode ($json_response, true);
        $this->assertEquals('WTC Istanbul', $json_serialize[1]['name']);
    }
}

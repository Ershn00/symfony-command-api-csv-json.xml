<?php

namespace App\Tests\Command;

use App\Services\ConvertCsvService;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ConvertCsvCommandTest extends TestCase
{
    public function testCsvCommand()
    {
        $convertCsv = new ConvertCsvService();
        $json_response = $convertCsv->processFile("http://127.0.0.1:8000/data.csv");
        $data = json_decode($json_response, true);

        $this->assertArrayHasKey(1, $data);
    }
}

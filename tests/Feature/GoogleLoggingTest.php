<?php

namespace Tests\Feature;

use Google\Api\Http;
use Google\Cloud\Logging\LoggingClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GoogleLoggingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_google_cloud_logging()
    {

        //É necessário criar uma chave e um projeto dentro do google cloud, baixar as credenciais em formato json para que possam ser importadas
        //dentro do arquivo json tem o projectId que deve ser passado
        $logging = new LoggingClient([
            'projectId' => 'crack-parser-359620', //deve ser mudado para o nome de seu projeto
            'keyFile' => json_decode(file_get_contents(__DIR__ . '/../../../google-credentials.json'), true) //deve ser mudado para o local de sua chave
        ]);

        $logger = $logging->logger('my_log');

        // Write a log entry.
        $logger->write('My log', [
            'custom_field' => 'custom_value',
            'name' => 'my custom log',
            'labels' => [
                'severity' => 'INFO',
                'env' => 'prod',
            ],
            'resource' => [
                'type' => 'gce_instance',
                'labels' => [
                    'instance_id' => '1234567890123456789',
                    'zone' => 'us-central1-f',
                ],
            ],
        ]);
    }
}

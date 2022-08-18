<?php

namespace Tests\Feature;

use App\Models\Log;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log as LogFacade;

class ElasticSearchTest extends TestCase
{
    public function test_orm_default_query()
    {
        $logs = Log::query()
            ->where('id', '<', 200000)
            ->where('message', 'like', '%Veniam%')
            ->get();

        $this->assertNotEmpty($logs);
    }

    public function test_elastic_search_query()
    {
        //por aqui é possivel se conectar direto com o Elastic cloud que pode ser integrado com o google cloud
        $client = ClientBuilder::create()
            ->setHosts(['localhost:9200'])
            ->build();

        //existem varios tipos de query mas essa funciona como se fosse do tipo like no SQL
        $params = [
            'index' => 'logs3',
            'body' => [
                'query' => [
                    'match' => ['message' => 'Veniam']
                ],
            ],
        ];

        $response = $client->search($params);

        $this->assertNotEmpty($response);
    }

    public function test_index_logs()
    {
        //por aqui é possivel se conectar direto com o Elastic cloud que pode ser integrado com o google cloud
        $client = ClientBuilder::create()
            ->setHosts(['localhost:9200'])
            ->build();

        //pode demorar pois indexar 200k de logs demora
        Log::query()->where('id', '<', 200000)->chunk(200, static function ($logs) use ($client) {
            foreach ($logs as $log) {
                $client->index([
                    'index' => 'logs',
                    'type' => 'log',
                    'id' => $log->id,
                    'body' => $log->toArray(),
                ]);
            }
        });
    }
}

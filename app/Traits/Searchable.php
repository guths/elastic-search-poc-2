<?php

namespace App\Traits;

use App\Observers\ElasticSearchObserver;
use Elastic\Elasticsearch\Client;

trait Searchable
{
    public static function bootSearchable()
    {
        if (config('services.search.enabled')) {
            static::observe(ElasticSearchObserver::class);
        }
    }

    public function elasticsearchIndex(Client $elasticsearchClient)
    {
        $elasticsearchClient->index([
            'index' => $this->getTable(),
            'type' => '_doc',
            'id' => $this->getKey(),
            'body' => $this->toElasticsearchDocumentArray(),
        ]);
    }

    public function elasticsearchDelete(Client $elasticsearchClient)
    {
        $elasticsearchClient->delete([
            'index' => $this->getTable(),
            'type' => '_doc',
            'id' => $this->getKey(),
        ]);
    }

    abstract public function toElasticsearchDocumentArray(): array;
}

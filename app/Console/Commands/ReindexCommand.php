<?php

namespace App\Console\Commands;

use App\Models\Log;
use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';

    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        parent::__construct();

        $this->elasticsearch = $elasticsearch;
    }

    public function handle()
    {
        $this->info('Indexing all articles. This might take a while...');

        foreach (Log::cursor() as $log)
        {
            $this->elasticsearch->index([
                'index' => $log->getSearchIndex(),
                'type' => $log->getSearchType(),
                'id' => $log->getKey(),
                'body' => $log->toSearchArray(),
            ]);

            $this->output->write('.');
        }

        $this->info("\nDone!");
    }
}

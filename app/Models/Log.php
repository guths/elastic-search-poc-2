<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    use Searchable;

    public function toElasticsearchDocumentArray(): array
    {
        // TODO: Implement toElasticsearchDocumentArray() method.
    }
}

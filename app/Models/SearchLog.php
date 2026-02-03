<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    protected $table = 'search_logs';

    protected $fillable = [
        'search_text',
        'ip_address',
        'searched_at'
    ];

    public $timestamps = false; 
}

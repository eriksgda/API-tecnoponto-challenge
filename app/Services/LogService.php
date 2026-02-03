<?php

namespace App\Services;

use App\Models\SearchLog;

class LogService
{

    public function __construct(){}

    public function getAllLogs() 
    {
        return Searchlog::latest('searched_at')->get();
    }

    public function store(string $name, string $ip): void
    {
        SearchLog::create([
            'search_text' => $name,
            'ip_address' => $ip,
            'searched_at' => now(),
        ]);
    }
}

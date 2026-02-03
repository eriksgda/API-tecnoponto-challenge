<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LogService;

class LogController
{
    private LogService $service;

    public function __construct(LogService $service)
    {
        $this->service = $service;
    }

    public function index() 
    {
        return response()->json($this->service->getAllLogs());
    }

}

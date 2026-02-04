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
        try {
            return response()->json(
                $this->service->getAllLogs(), 200);

        } catch (\Throwable $exception) {
            return response()->json([
                'message' => 'Erro ao buscar logs'
            ], 500);
        }
        
    }

}

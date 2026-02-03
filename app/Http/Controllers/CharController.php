<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExternalApiService;
use App\DTOs\CharResponseDTO;

class CharController
{
    private ExternalApiService $serivce;

    public function __construct(ExternalApiService $service)
    {
        $this->service = $service;
    }

    public function show(Request $request)
    {
        $charName = $request->query('name');
        $page = (int) $request->query('page', 1);

        $ip = $request->ip();

        if (!$charName) {
            return response()->json(['error' => 'Parâmetro name é obrigatório'], 400);
        }

        $response = $this->service->getCharByName($charName, $page, $ip);

        return response()->json($response, 200);
    }

}

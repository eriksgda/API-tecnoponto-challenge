<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExternalApiService;
use App\DTOs\CharResponseDTO;

class CharController
{
    private ExternalApiService $service;

    public function __construct(ExternalApiService $service)
    {
        $this->service = $service;
    }

    public function show(Request $request)
    {
        try {
            $charName = $request->query('name');
            $page = (int) $request->query('page', 1);
            
            $ip = $request->ip();
            
            $response = $this->service->getCharByName($charName, $page, $ip);
            
            return response()->json($response, 200);

        } catch (\DomainException $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ], 404);
        } catch (\RuntimeException $e) {
            return response()->json([
                'message' => 'Api externa indisponível, aguarde alguns instantes antes de buscar novamente',
                ], 503);
        } catch (\Throwable $exception){
            return response()->json([
                'message' => 'Erro interno'
            ], 500);
        }
    }
}

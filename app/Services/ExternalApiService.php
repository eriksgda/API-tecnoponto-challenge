<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;
use App\DTOs\CharResponseDTO;
use App\DTOs\EpisodeDTO;
use App\Enums\CharStatus;
use App\Services\LogService;
use App\Services\PaginationService;

class ExternalApiService
{
    private readonly string $baseUrl;
    private LogService $logService;
    private PaginationService $paginationService;

    public function __construct(
        LogService $logService, 
        PaginationService $paginationService
        )
    {
        $this->baseUrl = config('services.external_api.base_url');
        $this->logService = $logService;
        $this->paginationService = $paginationService;
    }

    public function getCharByName(string $name, int $page, string $ip): array
    {
        $response = Http::get("{$this->baseUrl}/character/?name={$name}&page={$page}");

        if ($response->status() === 404) {
            throw new \DomainException('Personagem não encontrado');
        }

        if ($response->failed()) {
            throw new \RuntimeException('Erro ao acessar API');
        }

        $this->logService->store($name, $ip);
        
        return [
            'pagination' => $this->paginationService->paginate($response->json('info'), $page),
            'data' => $this->mapToDTO($response->json('results'))
        ];
    }

    private function mapToDTO(array $results): array
    {
        return array_map( function($item) {
            $episodes = $this->getEpisodeData($item);

            return CharResponseDTO::fromApi($item, $episodes);

        }, $results);
    }

    private function getEpisodeData(array $item): array
    {
        $episodeUrls = $item['episode'] ?? [];
        $episodeIds = array_map(fn($url) => basename($url), $episodeUrls);

        $episodes = [];

        if (!empty($episodeIds)) {
            usleep(280_000);

            $response = Http::get("{$this->baseUrl}/episode/".implode(',', $episodeIds));
            $episodeData = $response->json();

            if (isset($episodeData['id'])) {
                $episodeData = [$episodeData];
            }

            $episodes = array_map(fn($ep) => EpisodeDTO::fromArray($ep), $episodeData);
        }        

        return $episodes;
    }
}

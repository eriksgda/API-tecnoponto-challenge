<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;
use App\DTOs\CharResponseDTO;
use App\DTOs\EpisodeDTO;
use App\Enums\CharStatus;
use App\Services\LogService;

class ExternalApiService
{
    private readonly string $baseUrl;
    private LogService $logService;

    public function __construct(LogService $logService)
    {
        $this->baseUrl = config('services.external_api.base_url');
        $this->logService = $logService;
    }

    public function getCharByName(string $name, int $page, string $ip): array
    {
        $response = Http::get("{$this->baseUrl}/character/?name={$name}&page={$page}");

        if ($response->failed()) {
            throw new Exception('Erro');
        }

        $this->logService->store($name, $ip);
        
        return [
            'pagination' => $this->paginate($response->json('info'), $page),
            'data' => $this->mapToDTO($response->json('results'))
        ];
    }

    private function paginate(array $info, int $currentPage): array
    {
        return [
            'total' => $info['count'] ?? null,
            'pages' => $info['pages'] ?? null,
            "current" => $currentPage,
            'next' => $currentPage < $info['pages'] ? $currentPage + 1 : null,
            'prev' => $currentPage > 1 ? $currentPage - 1 : null
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
            $response = Http::get("{$this->baseUrl}/episode/".implode(',', $episodeIds));
            $episodeData = $response->json();

            if (isset($episodeData['id'])) {
                $episodeData = [$episodeData];
            }

            $episodes = array_map(fn($ep) => EpisodeDTO::fromApi($ep), $episodeData);
        }        

        return $episodes;
    }
}

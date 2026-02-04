<?php

namespace App\Services;

class PaginationService
{
    public function __construct(){}

    public function paginate(array $info, int $currentPage): array
    {
        return [
            'total' => $info['count'] ?? null,
            'pages' => $info['pages'] ?? null,
            "current" => $currentPage,
            'next' => $currentPage < $info['pages'] ? $currentPage + 1 : null,
            'prev' => $currentPage > 1 ? $currentPage - 1 : null
        ];
    }
}

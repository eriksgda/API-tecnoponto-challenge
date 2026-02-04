<?php

namespace App\DTOs;

class LogDTO
{
    public function __construct(
        public int $id,
        public string $searchText,
        public string $ipAddress,
        public string $searchedAt,
    ){}

    public static function fromModel(array $data): self
    {
        return new self(
            id: $data['id'],
            searchText: $data['search_text'],
            ipAddress: $data['ip_address'],
            searchedAt: (string) $data['searched_at']
        );
    }
}

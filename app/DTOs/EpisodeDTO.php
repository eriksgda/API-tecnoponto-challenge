<?php

namespace App\DTOs;

class EpisodeDTO
{

    public function __construct(
        public string $name,
        public string $air_date,
        public string $episode,
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            air_date: $data['air_date'],
            episode: $data['episode'],
        );
    }
}

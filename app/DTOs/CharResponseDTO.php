<?php

namespace App\DTOs;

use App\Enums\CharStatus;

class CharResponseDTO
{

    public function __construct(
        public string $name,
        public string $status,
        public string $species,
        public string $type,
        public string $gender,
        public string $origin,
        public string $location,
        public string $image,
        public array $episodes
    ){}

    public static function fromApi(array $data, array $episodes): self
    {
        $status = CharStatus::from($data['status'])->translate();

        return new self(
            name: $data['name'],
            status: $status,
            species: $data['species'],
            type: $data['type'],
            gender: $data['gender'],
            origin: $data['origin']['name'],
            location: $data['location']['name'],
            image: $data['image'],
            episodes: $episodes
        );
    }
}

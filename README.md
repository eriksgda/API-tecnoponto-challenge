# API de Busca de Personagens

Este projeto é uma API desenvolvida como **teste técnico**, utilizando **Laravel**.  
Ela consome a API pública:

- https://rickandmortyapi.com

O sistema busca personagens, trata os dados retornados em JSON, converte em **DTOs** e expõe endpoints organizados para um **frontend em React**.

FRONTEND => https://github.com/eriksgda/WEB-tecnoponto-challenge


## Tecnologias Utilizadas

- PHP 8+
- Laravel 12+
- Composer
- MariaDB

## Instalação

Clone o repositório:

```bash
git clone https://github.com/eriksgda/API-tecnoponto-challenge.git
```

Instale as Dependências:

```bash
composer install
```

Copie o arquivo .env:

```bash
cp .env.example .env
```

Gere a chave da aplicação Laravel:

```bash
php artisan key:generate
```

Configure a URL base da API no .env:

```bash
EXTERNAL_API_BASE_URL=https://rickandmortyapi.com/api/
```

Configure suas credenciais do banco MariaDB:

```bash
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api_challenge
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

Rode as migrations:

```bash
php artisan migrate
```

Rode o servidor:

```bash
php artisan serve
```

## Endpoints da API

GET /api/personagens

parâmentros -> name e page

Exemplo:

```bash
GET /api/personagens?name=morty&page=2
```

Resposta:

```bash
{
  "pagination": {
    "total": 108,
    "pages": 6,
    "current": 2,
    "next": null,
    "prev": 1
  },
  "data": [
    {
      "name": "Morty Smith",
      "status": "Vivo",
      "species": "Human",
      "type": "",
      "gender": "Male",
      "origin": "Earth",
      "location": "Earth",
      "image": "https://rickandmortyapi.com/api/character/avatar/2.jpeg",
      "episodes": [
        {
          "name": "Pilot",
          "air_date": "December 2, 2013",
          "episode": "S01E01"
        }
      ]
    }
  ]
}
```

GET /api/logs

parâmentros -> name e page

Exemplo:

```bash
GET /api/logs
```

Resposta:

```bash
[
  {
    "id": 1,
    "searchText": "morty",
    "ipAddress": "127.0.0.1",
    "searchedAt": "2026-02-02 23:56:05"
  }
]
```

# Agenda

## Tecnolologias
- PHP
- Twig
- Doctrine

## Requisitos
- Docker
- Docker Compose

## Configuração do ambiente
Copiar o .env.example e preencher as variáveis
```sh
cp .env.example .env
```

Configuração do App
```sh
docker compose up -d --build
```

Instalação das dependências
```sh
docker exec agn-app composer install
```

Criação do schema do BD
```sh
docker exec agn-app php bin/doctrine.php orm:schema-tool:create
```

# Agenda
Aplicação para gerenciamento de uma Agenda, feito com PHP.

## Tecnologias
- Backend
  - [PHP](https://www.php.net)
  - [Doctrine ORM](https://www.doctrine-project.org)
- Frontend
  - [Twig](https://twig.symfony.com)
  - [Bulma](https://bulma.io)
  - [Cleave Zen](https://nosir.github.io/cleave-zen/)


## Requisitos
- Docker
- Docker Compose

## Configuração da Aplicação
### Variáveis de ambiente
Copiar o arquivo `.env` com base no `.env.example` e preencher as variáveis
```sh
cp .env.example .env
```
Exemplo de preenchimento
```sh
POSTGRES_HOST=postgres
POSTGRES_DB=agenda
POSTGRES_USER=postgres
POSTGRES_PASSWORD=postgres
```

### App
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

## Disponibilidade
Após a configuração, a aplicação estará disponível em:
```sh
http://localhost:8000
```

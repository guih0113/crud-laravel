# CRUD Laravel

API Laravel executada com Docker Compose, PHP 8.3 e MySQL 8.0.

## Pré-requisitos

Instale o [Docker Desktop](https://www.docker.com/products/docker-desktop/) e confirme que ele está aberto. PHP, Composer e MySQL são executados dentro dos containers, portanto não precisam ser instalados no Windows.

Os comandos abaixo usam PowerShell e devem ser executados na pasta raiz do projeto.

## Instalação do zero

### 1. Clonar o repositório

Substitua a URL pelo endereço deste repositório:

```powershell
git clone <URL_DO_REPOSITORIO> crud-laravel
cd crud-laravel
```

Se o repositório já foi clonado, apenas entre na pasta:

```powershell
cd C:\caminho\para\crud-laravel
```

### 2. Criar e configurar o ambiente

Crie o `.env` sem sobrescrever um arquivo que já exista:

```powershell
if (-not (Test-Path .env)) { Copy-Item .env.example .env }
```

No `.env`, altere a configuração padrão de SQLite para o serviço MySQL do Compose:

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

### 3. Construir e iniciar o MySQL

Construa a imagem da aplicação:

```powershell
docker compose build app
```

Inicie o banco:

```powershell
docker compose up -d mysql
```

Aguarde o MySQL aceitar conexões:

```powershell
docker compose exec mysql mysqladmin ping -h localhost -u root -proot --wait=30
```

### 4. Instalar dependências e preparar o Laravel

Instale as dependências PHP dentro do container:

```powershell
docker compose run --rm --no-deps app composer install
```

Gere a chave da aplicação:

```powershell
docker compose run --rm --no-deps app php artisan key:generate
```

### 5. Criar as tabelas e popular o banco

Execute todas as migrations e os seeders registrados em `DatabaseSeeder`:

```powershell
docker compose run --rm app php artisan migrate --seed
```

Esse comando executa `UserSeeder` e `LivroSeeder`. Para executar os seeders individualmente:

```powershell
docker compose run --rm app php artisan db:seed --class=UserSeeder
docker compose run --rm app php artisan db:seed --class=LivroSeeder
```

Para apagar todas as tabelas, recriá-las e popular o banco novamente:

```powershell
docker compose run --rm app php artisan migrate:fresh --seed
```

### 6. Gerar a documentação Swagger

Gere ou regenere o arquivo da documentação a partir das anotações da aplicação:

```powershell
docker compose run --rm --no-deps app php artisan l5-swagger:generate
```

O arquivo JSON será salvo em `storage/api-docs/api-docs.json`. Execute esse comando novamente sempre que alterar as anotações da API.

### 7. Iniciar a aplicação

Suba a aplicação e, opcionalmente, o phpMyAdmin:

```powershell
docker compose up -d app phpmyadmin
```

Confira os serviços:

```powershell
docker compose ps
```

A aplicação estará disponível em [http://localhost:8000](http://localhost:8000). A documentação Swagger estará em [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation), e o phpMyAdmin em [http://localhost:8080](http://localhost:8080).

## Endpoints da API

Os endpoints de livros usam o prefixo `/api`:

```text
GET    /api/livros
GET    /api/livros/{livro}
POST   /api/livros
PUT    /api/livros/{livro}
DELETE /api/livros/{livro}
```

## Comandos úteis

Ver os logs da aplicação:

```powershell
docker compose logs -f app
```

Executar os testes:

```powershell
docker compose run --rm --no-deps app php artisan test
```

Ver as rotas cadastradas:

```powershell
docker compose run --rm --no-deps app php artisan route:list
```

Parar os containers sem apagar os dados do MySQL:

```powershell
docker compose down
```

Subir novamente depois de uma parada normal:

```powershell
docker compose up -d
```

Para apagar os containers e também o volume do banco, recriando o banco do zero na próxima inicialização:

```powershell
docker compose down -v
```

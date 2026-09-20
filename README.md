# CRUD Laravel

Aplicação Laravel executada com Docker Compose, PHP 8.3 e MySQL 8.0.

## Pré-requisitos

Instale o [Docker Desktop](https://www.docker.com/products/docker-desktop/) e confirme que ele está aberto. Não é necessário instalar PHP ou Composer no Windows: ambos são fornecidos pelo container da aplicação.

Os comandos abaixo usam PowerShell e devem ser executados na pasta raiz do projeto.

## Inicialização completa

1. Entre na pasta do projeto:

   ```powershell
   cd C:\caminho\para\crud-laravel
   ```

2. Crie o arquivo de ambiente. Se ele já existir, preserve-o:

   ```powershell
   if (-not (Test-Path .env)) { Copy-Item .env.example .env }
   ```

3. Configure o `.env` para usar o serviço MySQL do Compose. Confira se estas linhas estão assim:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=laravel
   DB_PASSWORD=secret
   ```

4. Construa a imagem da aplicação:

   ```powershell
   docker compose build app
   ```

5. Inicie o banco de dados:

   ```powershell
   docker compose up -d mysql
   ```

6. Aguarde o MySQL aceitar conexões:

   ```powershell
   docker compose exec mysql mysqladmin ping -h localhost -u root -proot --wait=30
   ```

7. Instale as dependências PHP dentro do projeto:

   ```powershell
   docker compose run --rm --no-deps app composer install
   ```

8. Gere a chave da aplicação:

   ```powershell
   docker compose run --rm --no-deps app php artisan key:generate
   ```

9. Execute as migrations e os seeders:

   ```powershell
   docker compose run --rm app php artisan migrate --seed
   ```

10. Inicie a aplicação:

    ```powershell
    docker compose up -d app
    ```

11. Confirme o status dos serviços:

    ```powershell
    docker compose ps
    ```

12. Acesse a aplicação em [http://localhost:8000](http://localhost:8000).

## Assets do frontend

A página inicial possui um fallback de estilos e funciona sem compilar os assets. Para gerar `public/build`, instale o Node.js 20 ou superior no host e execute:

```powershell
npm install
npm run build
```

Depois, atualize a aplicação se necessário:

```powershell
docker compose restart app
```

## Comandos úteis

Ver os logs da aplicação:

```powershell
docker compose logs -f app
```

Executar testes:

```powershell
docker compose run --rm --no-deps app php artisan test
```

Parar os containers sem apagar os dados do MySQL:

```powershell
docker compose down
```

> Parar os containers e apagar também o volume do banco (ação destrutiva):

```powershell
docker compose down -v
```

Para subir novamente depois de uma parada normal:

```powershell
docker compose up -d
```

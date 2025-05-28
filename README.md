
# Repzone Laravel API

Projeto desenvolvido em Laravel focado no atendimento ao cliente por representantes alocados por zona/cidade.

---

## 📦 Tecnologias Utilizadas

- [Laravel](https://laravel.com/) 11+
- PHP 8.2+
- MySQL 8 (ou PostgreSQL)
- Composer
- Docker & Docker Compose

---

## ⚙️ Instalação Manual

```bash
# Clone o repositório
git clone https://github.com/Augusto-develop/repzone-laravel-api
cd repzone-laravel-api

# Instale as dependências
composer install

# Copie o arquivo .env e configure suas variáveis
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Execute as migrations para criar as tabelas no banco de dados
php artisan migrate

# (Opcional) Rode os seeders para popular dados iniciais
php artisan db:seed
```

---

## 👤 Usuário Base para Desenvolvimento

Um usuário base para testes é criado automaticamente via factory:

```php
User::factory()->create([
    'name' => 'Dev User',
    'email' => 'dev@email.com',
    'password' => Hash::make('123456'),
]);
```

- **Email:** dev@email.com  
- **Senha:** 123456

Use este usuário para login durante o desenvolvimento e testes.

---

## 🐳 Docker Compose — Ambiente de Desenvolvimento

Este projeto usa Docker Compose para facilitar o setup com MySQL e Laravel.

### Pré-requisito: Criar a network Docker

Antes de subir os containers, crie a network `personwallet-network`:

```bash
docker network create personwallet-network
```

### docker-compose.yml (resumo)

```yaml
version: '3.8'

services:
  prototype-upd8-laravel:
    build:
      context: .
      dockerfile: Dockerfile.dev
    ports:
      - "8000:8000"
    volumes:
      - ./repzone-laravel-api:/var/www:cached
    depends_on:
      - dbrepzone
    networks:
      - personwallet-network
    extra_hosts:
      - 'host.docker.internal:host-gateway'

  dbrepzone:
    image: mysql:8.0
    container_name: dbrepzone
    restart: always
    ports:
      - "3306:3306"
    environment:
      MYSQL_DATABASE: repzone
      MYSQL_USER: repzone
      MYSQL_PASSWORD: repzone
      MYSQL_ROOT_PASSWORD: root
    volumes:
      - mysql_data:/var/lib/mysql
    networks:
      - personwallet-network

networks:
  personwallet-network:
    external: true

volumes:
  mysql_data:
```

---

## 🚀 Executando o projeto com Docker

1. Build e startup dos containers:

```bash
docker-compose up --build
```

2. Para acessar o container Laravel:

```bash
docker exec -it prototype-upd8-laravel bash
```

3. Instale as dependências Laravel (caso necessário):

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

---

## 🌐 Acesso

- Laravel API: [http://localhost:8000](http://localhost:8000)
- MySQL disponível na porta 3306 (pode conectar com cliente externo)

---

## ⚠️ Observação para Dev Containers (VS Code, etc.)

Ao rodar o Laravel via `php artisan serve` dentro de um Dev Container, certifique-se de que ele esteja escutando no IP `0.0.0.0` para acesso externo:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

---

## 📂 Estrutura de Pastas

```
.
├── docker-compose.yml
├── Dockerfile.dev
└── repzone-laravel-api/
```

A pasta `repzone-laravel-api/` contém o código-fonte Laravel.

---

## 📄 Licença

Este projeto está licenciado sob os termos da [MIT License](LICENSE).

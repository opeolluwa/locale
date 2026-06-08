# Locale

A Yii2-based web application that provides country, currency, and flag data. It seeds and exposes a `country` table with country names, codes, currencies, and base64-encoded flag images sourced from `data/countries.json`.

## Tech Stack

- **PHP** 8.2+
- **Yii2** — web framework
- **MySQL 8.0** — primary database
- **Redis 7** — caching layer
- **Docker** — infrastructure (MySQL, Redis, RedisInsight, phpMyAdmin)
- **[just](https://just.systems)** — command runner

## Directory Structure

```
assets/         asset bundle definitions
commands/       console controllers
config/         application configuration (db, redis, web, params)
controllers/    web controllers
data/           countries.json seed data
mail/           email view layouts
migrations/     database migrations
models/         ActiveRecord and form models
runtime/        generated at runtime (logs, cache)
views/          web view templates
web/            entry script and public assets
```

## Requirements

- PHP 8.2+
- Composer
- Docker & Docker Compose
- `just` (`brew install just` on macOS)

## Setup

1. **Clone and configure**

   ```bash
   git clone <repo-url> locale
   cd locale
   just configure        # copies .env.example → .env and installs deps
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Start infrastructure**

   ```bash
   just dev              # starts Docker services and php yii serve
   ```

4. **Run migrations**

   ```bash
   php yii migrate
   ```

The app is available at `http://localhost:5006`.

## Environment Variables

Copy `.env.example` to `.env` and adjust as needed:

| Variable              | Default     | Description              |
|-----------------------|-------------|--------------------------|
| `PORT`                | `5006`      | PHP dev server port      |
| `DATABASE_HOST`       | `127.0.0.1` | MySQL host               |
| `DATABASE_PORT`       | `3309`      | MySQL mapped port        |
| `DATABASE_NAME`       | `locale`    | Database name            |
| `DATABASE_USERNAME`   | `local`     | Database user            |
| `DATABASE_PASSWORD`   | `locale`    | Database password        |
| `MYSQL_ROOT_PASSWORD` | `locale`    | MySQL root password      |

## Docker Services

| Service       | Port  | Description                |
|---------------|-------|----------------------------|
| MySQL         | 3309  | Primary database           |
| Redis         | 7963  | Cache                      |
| RedisInsight  | 5540  | Redis GUI                  |
| phpMyAdmin    | 8087  | Database GUI               |

## Just Commands

| Command        | Description                                      |
|----------------|--------------------------------------------------|
| `just dev`     | Start Docker services and run the PHP dev server |
| `just stop`    | Stop Docker services                             |
| `just restart` | Stop then start without clearing data            |
| `just rebuild` | Destroy volumes, rebuild, and restart            |
| `just kill`    | Destroy all containers and volumes               |
| `just logs`    | Tail Docker container logs                       |

## Migrations

Create a new migration:

```bash
just migrate-add create_my_table
# equivalent to: php yii migrate/create "create_my_table"
```

Run all pending migrations:

```bash
php yii migrate
```

## Testing

```bash
composer tests
# or directly:
vendor/bin/codecept run --env php-builtin
```

## License

BSD-3-Clause — see [LICENSE.md](LICENSE.md).

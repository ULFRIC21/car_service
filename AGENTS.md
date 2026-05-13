# AGENTS.md

## Cursor Cloud specific instructions

This is a **Laravel 8** application with user registration/authentication scaffolding (`laravel/ui`).

### Runtime requirements
- **PHP 8.1** (installed from `ppa:ondrej/php`) with extensions: `cli`, `common`, `curl`, `mbstring`, `xml`, `zip`, `sqlite3`, `mysql`, `bcmath`, `dom`
- **Composer** (installed at `/usr/local/bin/composer`)
- **Node.js 16** (via nvm) — required for Laravel Mix 6 asset compilation. Node 22+ is incompatible with the installed `laravel-mix@6` / `webpack@5.75` combination.

### Database
- The `.env` is configured to use **SQLite** (`DB_CONNECTION=sqlite`) with the database file at `database/database.sqlite`.
- Run `php artisan migrate` if the database file is empty or missing.

### Key commands
| Task | Command |
|---|---|
| Install PHP deps | `composer install` |
| Install JS deps | `source $HOME/.nvm/nvm.sh && nvm use 16 && npm install` (from repo root) |
| Compile assets | `source $HOME/.nvm/nvm.sh && nvm use 16 && npx mix` |
| Run tests | `php vendor/bin/phpunit` |
| Start dev server | `php artisan serve --host=0.0.0.0 --port=8000` |
| Run migrations | `php artisan migrate` |

### Gotchas
- **Node version**: You must use Node 16 via nvm for `npx mix` to work. The default Node 22 causes `ProgressPlugin` errors with webpack.
- **vendor/ is committed**: The `vendor/` directory is checked in to git, so `composer install` is fast (nothing to download) but still needed to regenerate autoload and discover packages.
- **No .gitignore entries**: The `.gitignore` file is empty. Be careful not to accidentally commit generated files like `node_modules/`, `database/database.sqlite`, or compiled assets.
- **PHPUnit config**: `phpunit.xml` has commented-out lines for SQLite in-memory testing. The current setup works with the file-based SQLite database.

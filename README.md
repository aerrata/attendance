## Install

```bash
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate:fresh --seed
npm install && npm run build
```

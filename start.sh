#!/bin/bash
cat > /var/www/.env << EOF
APP_NAME=laravel_web
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_URL=${APP_URL}

LOG_CHANNEL=stderr

DB_CONNECTION=pgsql
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}

SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_STORE=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync

VITE_APP_NAME=laravel_web
EOF

php artisan config:clear
php artisan serve --host=0.0.0.0 --port=8080

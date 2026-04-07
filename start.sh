#!/bin/bash
cat > /var/www/.env << EOF
APP_NAME=laravel_web
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_URL=https://laravel-web-2f0e.onrender.com
ASSET_URL=https://laravel-web-2f0e.onrender.com
FORCE_HTTPS=true
DB_CONNECTION=pgsql
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}
SESSION_DRIVER=file
CACHE_STORE=file
LOG_CHANNEL=stderr
EOF

php artisan config:clear
php artisan serve --host=0.0.0.0 --port=8080

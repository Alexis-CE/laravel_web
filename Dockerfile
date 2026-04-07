FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN echo "APP_NAME=laravel_web\n\
APP_ENV=production\n\
APP_KEY=base64:t86pDi9v2wWnNN9o/UapzHI0ChJa+IYdjQz7VYeYE9M=\n\
APP_DEBUG=false\n\
APP_URL=https://laravel-web-2f0e.onrender.com\n\
DB_CONNECTION=mysql\n\
DB_HOST=mysql-143a470d-pomelo-39fc.d.aivencloud.com\n\
DB_PORT=26434\n\
DB_DATABASE=defaultdb\n\
DB_USERNAME=avnadmin\n\
DB_PASSWORD=AVNS_JwYkmEd9UZLa6G-Bh5t\n\
MYSQL_ATTR_SSL_CA=/var/www/database/certs/ca.pem\n\
SESSION_DRIVER=file\n\
CACHE_STORE=file" > .env

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080

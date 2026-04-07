FROM php:8.4-cli

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Crear .env temporal solo para que composer no falle
RUN cp .env.example .env && \
    sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

# Al arrancar, sobreescribir .env con variables de entorno de Render
CMD cp .env.example .env && \
    sed -i "s|APP_KEY=.*|APP_KEY=${APP_KEY}|" .env && \
    sed -i "s|APP_ENV=.*|APP_ENV=${APP_ENV}|" .env && \
    sed -i "s|APP_URL=.*|APP_URL=${APP_URL}|" .env && \
    sed -i "s|DB_CONNECTION=.*|DB_CONNECTION=${DB_CONNECTION}|" .env && \
    sed -i "s|DB_HOST=.*|DB_HOST=${DB_HOST}|" .env && \
    sed -i "s|DB_PORT=.*|DB_PORT=${DB_PORT}|" .env && \
    sed -i "s|DB_DATABASE=.*|DB_DATABASE=${DB_DATABASE}|" .env && \
    sed -i "s|DB_USERNAME=.*|DB_USERNAME=${DB_USERNAME}|" .env && \
    sed -i "s|DB_PASSWORD=.*|DB_PASSWORD=${DB_PASSWORD}|" .env && \
    php artisan config:clear && \
    php artisan serve --host=0.0.0.0 --port=8080

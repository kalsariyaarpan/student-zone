FROM php:8.2-cli

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

RUN npm install
RUN npm run build

RUN mkdir -p storage/framework/{cache,sessions,views}
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 10000

CMD php artisan optimize:clear && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
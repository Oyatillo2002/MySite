FROM php:8.3-fpm-alpine

# Kerakli sistemaviy kutubxonalar
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite \
    nodejs \
    npm

# PHP Extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Avval dependency'larni yuklab olish (Cache uchun)
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Keyin qolgan kodlarni nusxalang
COPY . .

# Autoload va permissions
RUN composer dump-autoload --optimize && \
    chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
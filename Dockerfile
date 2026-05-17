FROM php:8.4-fpm

# Install dependencies bawaan Ubuntu/Debian yang stabil
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install ekstensi PHP pdo_mysql untuk koneksi database
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Ambil Composer versi terbaru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Atur working directory aplikasi
WORKDIR /var/www

# Copy seluruh source code project ke dalam container
COPY . /var/www

# Install dependency Laravel tanpa dev tools agar ringan
RUN composer install --no-interaction --optimize-autoloader --no-dev

EXPOSE 9000
CMD ["php-fpm"]
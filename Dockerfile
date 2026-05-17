FROM php:8.4-fpm-alpine

# Install extensions & dependencies yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install driver MySQL agar Laravel bisa konek database
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Ambil Composer terbaru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory di dalam container
WORKDIR /var/www

# Copy semua file project kita ke dalam container
COPY . /var/www

# Jalankan instalasi composer dependency
RUN composer install --no-interaction --optimize-autoloader --no-dev

EXPOSE 9000
CMD ["php-fpm"]
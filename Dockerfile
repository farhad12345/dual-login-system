# Use the official PHP image as the base image
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    unzip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set the working directory
WORKDIR /var/www/html

# Copy Composer from its official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel project files into the container
COPY . /var/www/html

# Set file permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

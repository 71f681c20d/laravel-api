# Use the official PHP image as base
FROM php:8.0-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files
COPY . .

# Install dependencies
RUN composer install

# Expose port
EXPOSE 8000

# Command to start the server
CMD php artisan serve --host=0.0.0.0 --port=8000

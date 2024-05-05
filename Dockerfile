# Use the official PHP image as base
FROM php:8.3.7RC1-fpm-alpine3.19

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apk --no-cache add postgresql-dev && \
    docker-php-ext-install pdo pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files
COPY . .

# Install dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install

# Expose port
EXPOSE 8000

# Command to start the server
CMD php artisan serve --host=0.0.0.0 --port=8000

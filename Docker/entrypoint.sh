# Use the PHP 8.1 base image
FROM php:latest as php

# Install dependencies
RUN apt-get update -y \
    && apt-get install -y unzip libpq-dev libcurl4-gnutls-dev \
    && docker-php-ext-install pdo pdo_mysql bcmath \
    && pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Copy composer binary
COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

# Copy entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/

# Set executable permission on entrypoint script
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set environment variables
ENV PORT=8000

# Set entry point
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

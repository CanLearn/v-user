# Use the PHP 8.1 base image
FROM php:8.1 as php

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

# Set environment variables
ENV PORT=8000

# Set entry point
ENTRYPOINT [ "docker/entrypoint.sh" ]

# ==============================================================================
# Node.js stage
FROM node:14-alpine as node

WORKDIR /usr/src/app

# Copy package.json and package-lock.json
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy the rest of the application
COPY . .

# Build your application
RUN npm run build

# Expose the port
EXPOSE 3000

# Command to run the application
CMD ["npm", "start"]

# Use the PHP 8.1 base image
FROM php:latest as php
RUN apt-get update -y && apt-get install -y unzip libpq-dev libcurl4-gnutls-dev && docker-php-ext-install pdo pdo_mysql bcmath  && pecl install -o -f redis && rm -rf /tmp/pear  && docker-php-ext-enable redis
ENV PORT=8000
WORKDIR /var/www
COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["bash", "/usr/local/bin/entrypoint.sh"]

COPY . .


# ==============================================================================
#  node
FROM node:14-alpine as node


RUN npm install --global cross-env
RUN npm install

VOLUME /var/www/node_modules

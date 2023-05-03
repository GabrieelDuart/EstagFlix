FROM php:8.1.0-apache

COPY app /var/www/html
WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt update && \
    docker-php-ext-install mysqli && \
    apt install unzip -y && \
    composer require vlucas/phpdotenv

EXPOSE 80



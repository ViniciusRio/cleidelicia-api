# syntax=docker/dockerfile:1
FROM php:8.2.7
COPY docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/
RUN apt-get update && apt-get install -y \
    libpq-dev \
    wget \
    build-essential \
    zlib1g-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

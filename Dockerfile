# syntax=docker/dockerfile:1
FROM php
COPY docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/
RUN apt-get update && apt-get install -y \
    libpq-dev \
    wget \
    build-essential \
    zlib1g-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

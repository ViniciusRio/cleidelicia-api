# syntax=docker/dockerfile:1
FROM php
RUN apt-get update && apt-get install -y \
    libpq-dev \
    wget \
    build-essential \
    zlib1g-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug
FROM php:8.2-fpm

RUN apt-get update \
    && apt-get install -y curl unzip git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

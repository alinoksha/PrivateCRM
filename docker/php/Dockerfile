FROM php:8.0.12-fpm

RUN docker-php-ext-install mysqli pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    apt update && \
    apt -y install git unzip

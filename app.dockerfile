FROM php:7.2-fpm AS builder

RUN apt-get update

FROM builder
RUN apt-get install -y --no-install-recommends \
    apt-utils \ 
    mysql-client \
    && docker-php-ext-install pdo_mysql
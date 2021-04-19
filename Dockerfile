FROM php:7.4-fpm

RUN apt-get update \
    && apt-get install -y zip curl libzip-dev libmcrypt-dev libjpeg-dev libpng-dev libfreetype6-dev libbz2-dev \
    && pecl install mcrypt-1.0.3 \
#    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install gd \
    && docker-php-ext-enable mysqli \
    && docker-php-ext-enable mcrypt \
    && apt-get clean

#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

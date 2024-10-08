FROM php:8.3.12-fpm

RUN apt update 
RUN apt install -y git libzip-dev unzip zip 

RUN docker-php-ext-install zip

RUN useradd -ms /bin/bash agenda
USER agenda

WORKDIR /var/www/html
COPY --chown=agenda:agenda . /var/www/html

COPY --from=composer:2.8.0 /usr/bin/composer /usr/local/bin/composer
RUN composer install


EXPOSE 9000

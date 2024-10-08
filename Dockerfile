FROM php:8.3.12-fpm

WORKDIR /var/www/html
COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

COPY --from=composer:2.8.0 /usr/bin/composer /usr/local/bin/composer
RUN composer install

EXPOSE 9000

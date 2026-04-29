ARG PHP_VERSION=8.2
FROM php:${PHP_VERSION}-fpm
ENV DRIVER=pcov

COPY ./php.ini /usr/local/etc/php/php.ini
COPY . /usr/src/dash
WORKDIR /usr/src/dash

RUN apt-get update && \
    apt-get install --yes --no-install-recommends git zip unzip libzip-dev
RUN pecl install pcov
COPY --from=composer:2 /usr/bin/composer /usr/bin/
RUN composer install

RUN make
CMD ["make", "test"]

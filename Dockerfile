FROM php:7.4-fpm
ENV DRIVER=pcov

COPY ./php.ini /usr/local/etc/php/php.ini
COPY . /usr/src/dash
WORKDIR /usr/src/dash

RUN apt-get update && \
    apt-get install --yes --no-install-recommends git zip unzip libzip-dev
RUN pecl install pcov
COPY --from=composer:2.8.5 /usr/bin/composer /usr/bin/
RUN composer install

RUN make
CMD ["make", "test"]

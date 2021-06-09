FROM php:7.4-fpm
ENV DRIVER pcov

COPY ./php.ini /usr/local/etc/php/php.ini
COPY . /usr/src/dash
WORKDIR /usr/src/dash

RUN apt-get update && \
    apt-get install --yes --no-install-recommends git zip unzip libzip-dev
RUN pecl install pcov
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer update --with-all-dependencies

RUN make
CMD make test

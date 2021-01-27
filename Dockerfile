FROM php:7.4-fpm
COPY . /usr/src/dash
WORKDIR /usr/src/dash
RUN apt-get update && \
    apt-get install --yes --no-install-recommends git zip unzip libzip-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN make
CMD make test

FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN set -eux;

RUN apk add --no-cache \
        oniguruma-dev \
        nodejs \
        npm \
        icu-dev \
        curl \
        curl-dev \
        libcurl \
        libzip-dev \
        libxml2-dev \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        imagemagick-dev \
        autoconf \
        g++ \
        make \
        bash \
        libwebp \
        libwebp-dev

RUN echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring intl zip curl dom soap
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd
RUN docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 80

CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "80"]

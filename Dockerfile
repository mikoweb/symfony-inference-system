FROM composer:latest AS composer
FROM php:8.3-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /var/www/symfony-inference-system
EXPOSE 80
COPY . /var/www/symfony-inference-system
ENV TZ=Europe/Warsaw

RUN apt-get update \
    && apt-get install -q -y \
        wget \
        vim \
        nano \
        mcedit \
        git \
        curl \
        libssh-dev \
        locales coreutils apt-utils libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev

RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "pl_PL.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

RUN docker-php-ext-configure intl
RUN docker-php-ext-install opcache intl mbstring xsl ctype iconv xml
RUN a2enmod rewrite
RUN a2enmod headers
RUN pecl install apcu
RUN docker-php-ext-enable apcu

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync

RUN wget https://getcomposer.org/download/latest-stable/composer.phar && php composer.phar install

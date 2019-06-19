FROM php:7-fpm

USER root

## APT UPDATE
RUN apt-get update

## CURL INSTALL
RUN apt-get install -y --no-install-recommends curl

## WGET INSTALL
RUN apt-get install -y --no-install-recommends wget

## GIT INSTALL
RUN apt-get install -y --no-install-recommends git

## UNZIP INSTALL
RUN apt-get install -y --no-install-recommends unzip

## CURL INSTALL
RUN apt-get install -y --no-install-recommends curl


## PHP Ext Installs

## PDO MYSQLI PDO_MYSQL INSTALL
RUN docker-php-ext-install mysqli pdo pdo_mysql

## 
RUN docker-php-ext-install bcmath

## 
RUN docker-php-ext-install mbstring

## 
RUN docker-php-ext-install opcache

## 
RUN docker-php-ext-install exif

## COMPOSER INSTALL
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

## FINALLY CONF
RUN usermod -u 1000 www-data

WORKDIR /var/www
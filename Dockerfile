FROM php:7-apache
RUN apt-get update
COPY ./php/php.ini /usr/local/etc/php/
COPY ./html/ /var/www/html
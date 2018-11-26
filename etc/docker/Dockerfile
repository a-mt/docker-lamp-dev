FROM php:7-apache

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data 

RUN apt-get update -y && apt-get install -y openssl libpng-dev curl libcurl4-openssl-dev
RUN docker-php-ext-install pdo pdo_mysql gd curl

RUN echo "ServerName localhost" >> /etc/apache2/httpd.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN a2enmod rewrite
RUN a2enmod ssl
RUN service apache2 restart

FROM php:7-apache

# Install LAMP
RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data 

RUN apt-get update -y && apt-get install -y openssl libpng-dev curl libcurl4-openssl-dev
RUN docker-php-ext-install pdo pdo_mysql gd curl mysqli

RUN echo "ServerName localhost" >> /etc/apache2/httpd.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN a2enmod rewrite
RUN a2enmod ssl

# Install phpMyAdmin
ENV PHPMYADMIN_VERSION=4.8.2

RUN set -ex; \
	curl --output /tmp/phpMyAdmin.tar.gz --location https://files.phpmyadmin.net/phpMyAdmin/${PHPMYADMIN_VERSION}/phpMyAdmin-${PHPMYADMIN_VERSION}-all-languages.tar.gz; \
	tar xfvz /tmp/phpMyAdmin.tar.gz -C /var/www; \
	ln -s /var/www/phpMyAdmin-${PHPMYADMIN_VERSION}-all-languages /var/www/phpmyadmin; \
	mv /var/www/phpmyadmin/config.sample.inc.php /var/www/phpmyadmin/config.inc.php; \
	rm -rf /var/www/phpmyadmin/{setup,examples,test,po}; \
	echo '@include("/var/www/phpmyadmin/config.user.inc.php");' >> /var/www/phpmyadmin/config.inc.php

# Start Apache
RUN service apache2 restart

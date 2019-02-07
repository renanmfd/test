FROM php:7.1.26-apache-stretch
# FROM php:7.2.14-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/docroot

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN chmod 755 -R /var/www/html

RUN docker-php-ext-install mysqli pdo pdo_mysql

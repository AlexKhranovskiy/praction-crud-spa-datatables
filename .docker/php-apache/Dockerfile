FROM php:8.1.2-apache

COPY ./../../ /var/www/html
COPY ./../../.docker/php-apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update

RUN docker-php-ext-install pdo_mysql

#RUN apt-get install redis-server -y

RUN a2enmod rewrite
RUN apt-get update && apt-get -y --no-install-recommends install git
RUN curl -sS https://getcomposer.org/installer | \
php -- --install-dir=/usr/local/bin --filename=composer

## install curl
#RUN apt-get install curl -y
## get install script and pass it to execute:
#RUN curl -sL https://deb.nodesource.com/setup_19.x | bash
## and install node
#RUN apt-get install nodejs
## confirm that it was successful
#RUN node -v
## npm installs automatically
#RUN npm -v

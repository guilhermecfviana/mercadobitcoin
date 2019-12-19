#####################################################
############ @author Guilherme Viana  ###############
#####################################################
FROM php:7.3-apache

# Realiza a instalação de extenções necessárias para a aplicação
RUN apt-get update && apt-get -y upgrade
RUN apt-get install -y libpq-dev libxml2-dev libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libfreetype6-dev
RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev
RUN docker-php-ext-install mbstring
RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip
RUN docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir \
    --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir \
    --enable-gd-native-ttf
RUN docker-php-ext-install gd opcache xml pdo pdo_pgsql pgsql
RUN a2enmod rewrite
#RUN pecl install xdebug
#RUN docker-php-ext-enable xdebug
RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip
RUN cd ~
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y tzdata
RUN service apache2 restart
RUN rm /var/log/apache2/access.log
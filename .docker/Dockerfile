FROM php:8.2-apache


USER root

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chown root:root /var/www/html
RUN chmod -R g+w /var/www/html
RUN chown -R www-data:www-data /var/www/*
RUN chmod -R 775 /var/www/html
RUN chmod -R 777 /var/www/*

WORKDIR /var/www/html

RUN chown root:root /var/www/html
RUN chmod -R g+w /var/www/html
RUN chown -R www-data:www-data /var/www/*
RUN chmod -R 775 /var/www/html
RUN a2enmod rewrite

COPY .docker/default.conf /etc/apache2/sites-enabled/000-default.conf

ENV COMPOSER_ALLOW_SUPERUSER=1

EXPOSE 80

VOLUME [ "/var/www/html" ]

CMD ["apache2-foreground"] 

FROM php:8.2-apache

USER root

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar dependencias adicionales
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar la configuración de Apache
COPY .docker/default.conf /etc/apache2/sites-enabled/000-default.conf

# Copiar el contenido del proyecto al contenedor
COPY . /var/www/html

# Establecer permisos y propietarios
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Ejecutar composer install
RUN composer install --no-interaction --optimize-autoloader

ENV COMPOSER_ALLOW_SUPERUSER=1

EXPOSE 80

CMD ["apache2-foreground"]


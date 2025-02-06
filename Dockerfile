# Usamos una imagen de PHP con Apache
FROM php:8.2-apache

# Instalamos dependencias necesarias para Laravel
RUN apt-get update && apt-get install -y \
    zip unzip git \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Copiamos los archivos del proyecto Laravel
COPY . /var/www/html

# Instalamos Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Ejecutamos composer install para instalar las dependencias de Laravel
RUN cd /var/www/html && composer install && composer update

# Copiar tu apache2.conf personalizado al contenedor
COPY apache2.conf /etc/apache2/apache2.conf

# Copiar tu archivo de configuración de VirtualHost al contenedor
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Habilitar mod_headers para las cabeceras HTTP
RUN a2enmod headers

# Habilitamos el módulo de Apache para reescritura de URL
RUN a2enmod rewrite

# Reiniciar Apache para aplicar los cambios
RUN service apache2 restart


# Configuramos los permisos
RUN chown -R www-data:www-data /var/www/html

# Configuramos el archivo de configuración de Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf


# Exponemos el puerto 80
EXPOSE 80

# Iniciamos Apache
CMD ["apache2-foreground"]

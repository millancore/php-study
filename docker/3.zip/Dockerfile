FROM php:7.3-apache

# Agregamos el proyecto comprimido
ADD myapp.tar /var/www/html

# Habilitamos mod_rewrite y definimos permisos
RUN a2enmod rewrite; \
    chown -R www-data:www-data /var/www/html

# Remplazamos el vhost por defecto por el nuestro
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
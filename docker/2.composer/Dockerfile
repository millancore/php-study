FROM composer:1.9 AS composer

#compiamos nuestra app al contenedor builder (composer)
COPY composer.json /app

WORKDIR /app

# instalamos dependencias de composer
RUN composer install --no-dev

# ----------

FROM php:7.4-apache

# Copiamos desde build (composer)
COPY --from=composer /app/vendor /var/www/html/vendor
 
# Habilitamos mod_rewrite y definimos permisos
#RUN chown -R www-data:www-data /var/www/html


# Remplazamos el vhost por defecto por el nuestro
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
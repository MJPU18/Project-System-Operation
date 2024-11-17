# Usar una imagen base con PHP y Nginx
FROM php:7.4-fpm

# Instalar Nginx y extensiones necesarias para PHP
RUN apt-get update && apt-get install -y nginx sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite

# Copiar la aplicación
COPY ./index.php /var/www/html/index.php
COPY ./myapp.db /var/www/html/myapp.db

# Copiar la configuración de Nginx
COPY ./default /etc/nginx/sites-available/default
COPY ./php.ini /var/log/nginx


# Configurar permisos para los archivos
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar PHP-FPM y Nginx
CMD ["bash", "-c", "php-fpm & nginx -g 'daemon off;'"]


FROM php:8.2-apache

# 1. Extensiones
RUN docker-php-ext-install pdo pdo_mysql mysqli

# 2. Creamos una configuración TOTALMENTE NUEVA con otro nombre
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/misitio.conf

# 3. Desactivamos el sitio con error y activamos el nuevo
RUN a2dissite 000-default.conf && a2ensite misitio.conf

WORKDIR /var/www/html

COPY src/ .

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
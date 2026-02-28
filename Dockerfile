FROM php:8.2-apache

# Instalamos las extensiones necesarias (pdo para lo antiguo, mysqli para lo nuevo)
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Configuramos el directorio de trabajo
WORKDIR /var/www/html

# Copiamos el contenido de tu carpeta src (donde están home.php, login.php, etc.)
COPY src/ .

# Ajustamos permisos para que Apache pueda leer los archivos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
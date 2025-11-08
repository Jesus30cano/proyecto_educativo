FROM php:8.3-apache

# Instalar dependencias del sistema necesarias para extensiones de PHP
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-enable pdo pdo_pgsql pgsql

# Instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

# Copiar configuración de Apache (ruta adaptada si usas otra carpeta)
COPY ./apache-config/000-default.conf /etc/apache2/sites-available/000-default.conf

# Habilitar mod_rewrite (para URLs amigables en PHP)
RUN a2enmod rewrite

# Definir directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copiar el proyecto al contenedor
COPY ./src /var/www/html

# Instalar dependencias definidas en composer.json
RUN composer install --no-dev --optimize-autoloader || true

# Exponer el puerto de Apache
EXPOSE 80

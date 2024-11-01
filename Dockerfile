#Imagen de PHP
FROM php:8.2-fpm

# Copiamos composer.lock y composer.json al directorio /var/www/
COPY composer.lock composer.json /var/www/

# Establecemos el directorio de trabajo en /var/www/
WORKDIR /var/www

# Instalamos las dependencias necesarias
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    libgd-dev

# Limpiamos la caché de apt para reducir el tamaño de la imagen
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalamos las extensiones de PHP necesarias
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-install bcmath
RUN docker-php-ext-configure gd --with-external-gd
RUN docker-php-ext-install gd

# Descargamos e instalamos Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalamos Node.js y npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Creamos un grupo y un usuario para la aplicación Laravel
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copiamos el contenido del directorio de nuestra aplicación al contenedor
COPY . /var/www

# Establecemos los permisos correctos
RUN chown -R www:www /var/www \
    && chmod -R 755 /var/www \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

# Aseguramos que el directorio storage y sus subdirectorios tengan los permisos correctos
RUN mkdir -p /var/www/storage/app/public \
    && chmod -R 775 /var/www/storage/app/public \
    && chown -R www:www /var/www/storage


# Copiamos el archivo .env
COPY .env.example /var/www/.env

# Cambiamos al usuario www
USER www

# Exponemos el puerto 9000 y arrancamos el servidor php-fpm
EXPOSE 9000

FROM php:8.2-apache

# 1. Installation des dépendances système (Zip, MongoDB, SSL)
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    unzip \
    && docker-php-ext-install pdo_mysql zip

# 2. Activation du module rewrite
RUN a2enmod rewrite

# 3. Installation de l'extension MongoDB pour PHP
RUN pecl install mongodb && docker-php-ext-enable mongodb

# 4. INSTALLATION DE COMPOSER (C'est la ligne magique qui te manquait)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Configuration Apache et dossier de travail
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf
WORKDIR /var/www/html
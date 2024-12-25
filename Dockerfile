## Utiliser une image de base officielle PHP avec FPM
#FROM php:8.3-fpm
#
## Installer les dépendances système
#RUN apt-get update && apt-get install -y \
#    git \
#    curl \
#    libpng-dev \
#    libonig-dev \
#    libxml2-dev \
#    zip \
#    unzip \
#    libpq-dev
#
## Installer les extensions PHP requises
#RUN docker-php-ext-install  pdo_pgsql mbstring exif pcntl bcmath gd
#
## Installer Composer
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
#
## Configurer le répertoire de travail
#WORKDIR /var/www
#
## Copier les fichiers d'application
#COPY . .
#
## Installer les dépendances PHP
#RUN composer install --no-scripts --no-autoloader
#
## Générer l'autoloader optimisé
#RUN composer dump-autoload --optimize
#
## Copier le fichier d'environnement
#COPY .env.example .env
#
## Générer la clé d'application
#RUN php artisan key:generate
#
## Assurez-vous que les fichiers de cache et de logs sont accessibles en écriture
#RUN chown -R www-data:www-data \
#    /var/www/storage \
#    /var/www/bootstrap/cache
#
## Exposer le port 9000 et démarrer PHP-FPM
#EXPOSE 9000
##CMD ["php-fpm"]
#CMD php artisan serve --host=0.0.0.0 --port=8000


# ameliorer pour le jenkins
# Utiliser une image de base officielle PHP avec FPM
FROM php:8.3-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    nginx

# Installer les extensions PHP requises
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurer le répertoire de travail
WORKDIR /var/www

# Copier les fichiers d'application
COPY . .

# Installer les dépendances PHP
RUN composer install --no-scripts --no-autoloader

# Générer l'autoloader optimisé
RUN composer dump-autoload --optimize

# Copier le fichier d'environnement
COPY .env.example .env

# Générer la clé d'application
RUN php artisan key:generate

# Assurez-vous que les fichiers de cache et de logs sont accessibles en écriture
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Configurer et démarrer Nginx avec PHP-FPM
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf
EXPOSE 80

CMD service nginx start && php-fpm

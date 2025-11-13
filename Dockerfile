FROM php:8.2-apache

# Install extensions yang dibutuhkan
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    && docker-php-ext-install pdo pdo_mysql

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copy semua file ke container
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Jalankan composer install
RUN composer install --no-dev --optimize-autoloader

# Set permission folder Laravel
RUN chmod -R 775 storage bootstrap/cache

# Expose port 80 (buat Apache)
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
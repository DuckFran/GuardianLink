# Use the official PHP image with Apache
FROM php:8.2-apache

# Install the MySQL extensions needed for PHP to talk to the DB
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Set the working directory in the container
WORKDIR /var/www/html

# Give the web server permission to read/write your files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80
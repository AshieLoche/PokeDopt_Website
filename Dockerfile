# Use the official PHP image with Apache
FROM php:7.4-apache

# Copy the application files to the Apache web directory
COPY . /var/www/html/

# Install any necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expose port 80
EXPOSE 80

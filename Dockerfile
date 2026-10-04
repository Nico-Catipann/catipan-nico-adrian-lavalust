ARG PHP_VERSION=8.5

FROM php:${PHP_VERSION}-apache

# =========================================
# PHP EXTENSIONS
# =========================================

# Install PDO MySQL
RUN docker-php-ext-install pdo_mysql


# =========================================
# APACHE
# =========================================

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# LavaLust should serve from public/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Change Apache document root
RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Allow .htaccess inside LavaLust public directory
RUN printf '<Directory /var/www/html/public>\n\
AllowOverride All\n\
Require all granted\n\
</Directory>\n' \
    > /etc/apache2/conf-available/lavalust.conf \
    && a2enconf lavalust


# =========================================
# APPLICATION
# =========================================

WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html/


# =========================================
# DIRECTORIES / PERMISSIONS
# =========================================

# Make sure required folders exist
RUN mkdir -p /var/www/html/public/uploads/products \
    && mkdir -p /var/www/html/runtime

# Apache user owns project files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html


# =========================================
# RENDER PORT
# =========================================

EXPOSE 10000

# Render provides PORT at runtime.
# Default to 10000 if PORT is not set.
CMD ["sh", "-c", "sed -ri \"s/^Listen .*/Listen ${PORT:-10000}/\" /etc/apache2/ports.conf && sed -ri \"s/<VirtualHost \\*:[0-9]+>/<VirtualHost *:${PORT:-10000}>/\" /etc/apache2/sites-available/000-default.conf && apache2-foreground"]
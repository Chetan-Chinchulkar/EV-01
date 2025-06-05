FROM php:8.2-apache

# Install SQLite development libraries and extension
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Copy application files
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/ && \
    chmod +x /var/www/html/docker-entrypoint.sh

# Configure Apache
RUN a2enmod rewrite

# Use custom entrypoint
ENTRYPOINT ["/var/www/html/docker-entrypoint.sh"]

# Use Apache's default configuration
EXPOSE 80 

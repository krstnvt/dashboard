FROM php:8.3-fpm

# Install system dependencies in one layer
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libpq-dev nodejs npm \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy dependency files first for better caching
COPY composer.json composer.lock package.json package-lock.json ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application code
COPY . .
COPY --chown=www-data:www-data . .

# Install all npm dependencies and build assets
RUN npm install && npm run build && rm -rf node_modules

USER www-data
EXPOSE 9000
CMD ["php-fpm"]
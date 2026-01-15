FROM php:8.3-fpm

# system deps
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    default-mysql-client \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# php extensions
RUN docker-php-ext-install pdo_mysql zip bcmath

# Composer
COPY --from=composer:2.9 /usr/bin/composer /usr/bin/composer

# Create www user
RUN useradd -G www-data,root -u 1000 -m developer
RUN mkdir -p /var/www/html
WORKDIR /var/www/html

# expose
EXPOSE 9000

CMD ["php-fpm"]

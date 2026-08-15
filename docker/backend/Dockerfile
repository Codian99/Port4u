# syntax=docker/dockerfile:1

FROM php:8.4-cli-alpine

# System dependencies
RUN apk add --no-cache \
    bash \
    curl \
    git \
    unzip \
    $PHPIZE_DEPS \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
  && docker-php-ext-install \
    pdo_mysql \
    opcache \
    bcmath \
    mbstring \
    intl \
    zip \
  && pecl install redis \
  && docker-php-ext-enable redis \
  && apk del $PHPIZE_DEPS

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY backend/ /app/

# Production dependencies only
RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader \
  && chown -R www-data:www-data /app/storage /app/bootstrap/cache

COPY docker/backend/php.ini /usr/local/etc/php/conf.d/portfolio.ini
COPY docker/backend/entrypoint.sh /usr/local/bin/portfolio-entrypoint
RUN chmod +x /usr/local/bin/portfolio-entrypoint

EXPOSE 8000

ENTRYPOINT ["sh", "/usr/local/bin/portfolio-entrypoint"]

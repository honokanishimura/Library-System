# ベースイメージにPHPとApache、MySQLサポートを含むものを指定
FROM php:8.2-apache

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Composerインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apacheのドキュメントルート設定
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Laravelプロジェクトのコピー
COPY . /var/www/html

# 作業ディレクトリ
WORKDIR /var/www/html

# Laravelのパーミッション対応
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Laravelセットアップ
RUN composer install --no-dev --optimize-autoloader \
    && cp .env.example .env \
    && php artisan key:generate \
    && php artisan migrate --force \
    && php artisan config:cache


# Apacheを起動
CMD ["apache2-foreground"]

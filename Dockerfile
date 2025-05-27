# Usa imagem base do PHP com FPM
FROM php:8.2-fpm

# Instala dependências do sistema e extensões necessárias do PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Instala dependências do Laravel
RUN composer install --optimize-autoloader --no-dev

# Define permissões (pode ser ajustado conforme necessidade)
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Expõe a porta FPM (não usada diretamente no Render, mas boa prática)
EXPOSE 10000

# Comando padrão de execução (Render ignora esse CMD e usa Procfile)
CMD ["php-fpm"]

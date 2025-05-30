FROM php:8.3-apache

RUN apt update

RUN apt upgrade -y

# 1. development packages
RUN apt-get install -y \
    git \
    libzip-dev \
    zip \
    curl \
    sudo \
    unzip \
    libicu-dev \
    libbz2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libgmp-dev \
    libldap2-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++

RUN set -eux; \
	docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg; \
	docker-php-ext-configure intl; \
	docker-php-ext-configure mysqli --with-mysqli=mysqlnd; \
	docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd; \
	docker-php-ext-configure zip; \
	docker-php-ext-install -j$(nproc) \
		gd \
		intl \
		mysqli \
		opcache \
		pdo_mysql \
		zip

RUN pecl install xdebug-3.3.0

# 2. apache configs + document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/service
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# 4. start with base php config, then add extensions
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install \
    bz2 \
    intl \
    iconv \
    bcmath \
    opcache \
    calendar \
    pdo_mysql \
    zip

# RUN docker-php-ext-enable xdebug

# 5. composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. we need a user with the same UID/GID with host user
# so when we execute CLI commands, all the host file's ownership remains intact
# otherwise command from inside container will create root-owned files and directories
ARG uid
RUN useradd -G www-data,root -u $uid -d /home/devuser devuser
RUN mkdir -p /home/devuser/.composer && \
    chown -R devuser:devuser /home/devuser

RUN mkdir -p /var/www/html/application/files/cache && chown -R www-data:www-data /var/www/html/application/files/cache && chmod -R 775 /var/www/html/application/files/cache
RUN mkdir -p /var/www/html/application/config/doctrine && chown -R www-data:www-data /var/www/html/application/config/doctrine && chmod -R 775 /var/www/html/application/config/doctrine
RUN pecl install excimer

RUN printf 'y\n1\n\1n' | apt install nodejs
RUN apt install -y npm
RUN npm install -g yarn

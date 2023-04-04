FROM php:8.1-fpm-alpine

RUN apk add --no-cache libpng libpng-dev && docker-php-ext-install gd && apk del libpng-dev

# Arguments defined in docker-compose.yml
ARG user
ARG uid

RUN apk update \
    && apk upgrade \
    && apk add --no-cache \
        oniguruma-dev \
        freetype \
        libpng \
        libjpeg-turbo \
        freetype-dev \
        libpng-dev \
        jpeg-dev \
        libwebp-dev \
        libjpeg \
        libjpeg-turbo-dev \
        zip \
        unzip \
        pcre-dev ${PHPIZE_DEPS}

RUN docker-php-ext-configure gd \
        --with-freetype=/usr/lib/ \
        --with-jpeg=/usr/lib/ \
        --with-webp=/usr

RUN NUMPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
    && docker-php-ext-install -j${NUMPROC} gd

RUN apk add --no-cache sqlite-libs
RUN apk add --no-cache icu sqlite git openssh zip
RUN apk add --no-cache --virtual .build-deps icu-dev libxml2-dev sqlite-dev curl-dev
RUN docker-php-ext-install \
        bcmath \
        curl \
        ctype \
        intl \
        pdo \
        pdo_sqlite \
        xml \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        sockets

RUN apk del .build-deps

RUN docker-php-ext-enable pdo_sqlite

# Install redis
RUN pecl update-channels && pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add xdebug
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS
RUN apk add --update linux-headers
RUN pecl install xdebug-3.1.5
RUN docker-php-ext-enable xdebug
RUN apk del -f .build-deps

# Configure Xdebug
COPY ./conf.d/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Create system user to run Composer and Artisan Commands
RUN adduser -D -G www-data -u ${uid} -h /home/${user} ${user}
RUN mkdir -p /home/${user}/.composer && \
    mkdir -p /home/${user}/.xdebug && \
    touch /home/${user}/.xdebug/xdebug.log && \
    chown -R ${user}:www-data /home/${user}

# Set working directory
WORKDIR /var/www/html

USER $user

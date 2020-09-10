FROM php:7.4-fpm-alpine

ENV EXT_APCU_VERSION=5.1.18

RUN apk --no-cache --virtual .build-deps add postgresql-dev openssl-dev \
    && docker-php-source extract \
    # ext-opache
    && docker-php-ext-enable opcache \
    # ext-apcu
    && mkdir -p /usr/src/php/ext/apcu \
    && curl -fsSL https://github.com/krakjoe/apcu/archive/v$EXT_APCU_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/apcu --strip 1 \
    # install
    && docker-php-ext-install \
        apcu \
        pdo_pgsql \
        pcntl \
    &&  docker-php-source delete \
    && apk del .build-deps \
    && apk --no-cache add libpq \
    &&  echo -e '\
opcache.interned_strings_buffer=16\n\
opcache.load_comments=Off\n\
opcache.max_accelerated_files=16000\n\
opcache.save_comments=Off\n\
' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin --filename=composer && chmod +x /usr/bin/composer

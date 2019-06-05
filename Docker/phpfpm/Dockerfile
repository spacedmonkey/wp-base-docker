FROM php:7.3-fpm

ENV PHPREDIS_VERSION 3.1.2

RUN     apt-get update; \
        apt-get install -y \
        $PHPIZE_DEPS \
        libcurl3 \
        libcurl3-dev \
        libicu-dev \
        libjpeg-dev \
        libmcrypt-dev \
        libpng-dev \
        libssl-dev \
        libxml2 \
        libxml2-dev \
        libxpm-dev \
        libxslt-dev \
        wget \

    &&	apt-get install -y \
        bash \
        grep \
        git \
        mariadb-client \
        subversion \

	&&  rm -rf /var/lib/apt/lists/* \

    && 	docker-php-ext-configure gd \
       		--with-png-dir=/usr \
       		--with-jpeg-dir=/usr \

    && docker-php-ext-install \
        bcmath \
        curl \
        exif \
        gd \
        ftp \
        iconv \
        json \
        intl \
        mbstring \
        mysqli \
        opcache \
        sockets \
        xmlrpc \
        xsl \
        zip \
        xml \

    # Install php-redis
    && curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz  \
    && mkdir /tmp/redis \
    && tar -xf /tmp/redis.tar.gz -C /tmp/redis \
    && rm /tmp/redis.tar.gz \
    && ( \
    cd /tmp/redis/phpredis-$PHPREDIS_VERSION \
    && phpize \
        && ./configure \
    && make -j$(nproc) \
        && make install \
    ) \
    && rm -r /tmp/redis \
    && docker-php-ext-enable redis


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install wp-cli
RUN curl -o /usr/local/bin/wp -SL https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli-nightly.phar \
    && chmod +x /usr/local/bin/wp \
    && echo 'alias wp="wp --allow-root"' >>  ~/.bashrc

WORKDIR /var/www/html/

CMD ["php-fpm"]

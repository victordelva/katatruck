FROM php:7.4-fpm AS development

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

WORKDIR /var/www

RUN apt-get update && apt-get install -y    \
    zip                                     \
    vim                                     \
    unzip                                   \
    git                                     \
    autoconf automake make gcc g++ bash     \
    libzip-dev libpcre3-dev                 \
    curl                                    \
    libicu-dev                              \
    wget                                    \
    netcat                                  ;

RUN docker-php-ext-configure intl &&        \
    docker-php-ext-install intl             ;

RUN docker-php-ext-install -j$(nproc) \
            bcmath \
            zip \
            pdo_mysql;

RUN apt-get clean &&                        \
    rm -rf /var/lib/apt/lists/*             ;

RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin   \
    --filename=composer   --version=1.10.7  ;

ADD fpm/etc/infrastructure/php/extensions/xdebug.sh /root/install-xdebug.sh
RUN sh /root/install-xdebug.sh

COPY fpm/etc/infrastructure/php/ /usr/local/etc/php/

RUN chown root:root /var/www
RUN chmod 755 /var/www/

USER www

EXPOSE 9000
CMD ["php-fpm"]
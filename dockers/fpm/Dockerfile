FROM php:7.4-fpm AS development

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

WORKDIR /var/www

RUN apt-get update && apt-get install -y    \
    zip                                     \
    vim                                     \
    unzip                                   \
    git                                     \
    curl                                    \
    libicu-dev                              \
    wget                                    \
    netcat                                  ;

RUN docker-php-ext-configure intl &&        \
    docker-php-ext-install intl             ;

RUN apt-get clean &&                        \
    rm -rf /var/lib/apt/lists/*             ;

RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin   \
    --filename=composer   --version=1.10.7  ;

RUN chown root:root /var/www
RUN chmod 755 /var/www/

USER www


EXPOSE 9000
CMD ["php-fpm"]
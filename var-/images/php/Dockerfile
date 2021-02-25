    FROM php:7.4-fpm
    
    RUN apt-get update && apt-get install -y \
            curl \
            wget \
            libfreetype6-dev \
            libjpeg62-turbo-dev \
            libmcrypt-dev \
        && pecl install xdebug-3.0.3 \
        && docker-php-ext-enable xdebug   
        
    ADD ./php.ini /var/images/php/php.ini             
    
    WORKDIR /var/www
    
    CMD ["php-fpm"]

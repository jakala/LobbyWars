FROM php:8.0
RUN pecl channel-update pecl.php.net  && pecl install xdebug && docker-php-ext-enable xdebug
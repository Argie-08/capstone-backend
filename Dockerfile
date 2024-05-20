FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV DB_CONNECTION pgsql
ENV DB_HOST dpg-cp0kah21hbls73ec5u0g-a
ENV DB_PORT 5432
ENV DB_DATABASE horizone_shop
ENV DB_USERNAME horizone_shop_user
ENV DB_PASSWORD qKJgy4mnoJHVbaLcPg6ooD95CREPMVFc

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
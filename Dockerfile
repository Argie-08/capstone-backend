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
ENV DB_HOST dpg-cr4t66o8fa8c73a7hgb0-a.singapore-postgres.render.com
ENV DB_PORT 5432
ENV DB_DATABASE horizonedb
ENV DB_USERNAME horizoneuser
ENV DB_PASSWORD r2ugth9JfkPjL2ZYT8gJjpEWbU9eqvOy

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
FROM richarvey/nginx-php-fpm:3.1.6

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
ENV LOG_CHANNEL stderr
ENV DATABASE_URL postgres://apitest_h7lq_user:Yx8uIXSUf0qmAIbQFIzEQiIljYUJvdNx@dpg-cnurkjfsc6pc73cpbok0-a/apitest_h7lq
ENV DB_CONNECTION pgsql
ENV APP_KEY	base64:/XNQmemr+cluWcbgZs5Z3dIlMfU1aYGNgtl3XQahcG4=

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]

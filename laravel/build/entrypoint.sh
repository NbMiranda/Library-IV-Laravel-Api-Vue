#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
    set -- php-fpm "$@"
fi

cd /var/www/html && composer install && php artisan key:generate && php artisan migrate && php artisan jwt:secret

exec "$@"
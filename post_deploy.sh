#!/bin/sh

# update application cache
# comment line if you do not want to run migrations on build
#php artisan migrate:fresh --seed --force
#php artisan passport:install
php artisan migrate --force
php artisan DB:seed --class=InclusiveScoreQaPointsSeeder
php artisan passport:keys
php artisan lighthouse:clear-cache
php artisan lighthouse:cache
php artisan optimize:clear
# start the application

php-fpm -D &&  nginx -g "daemon off;"
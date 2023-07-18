FROM 581456186916.dkr.ecr.us-east-1.amazonaws.com/base:php8.1.fpm
ENV APP_ENV=dev
# setup user as root
USER root

ARG AWS_ACCESS_KEY_ID
ARG AWS_SECRET_ACCESS_KEY

ARG NOVA_USERNAME
ARG NOVA_PASSWORD

ENV AWS_ACCESS_KEY_ID=$AWS_ACCESS_KEY_ID
ENV AWS_SECRET_ACCESS_KEY=$AWS_SECRET_ACCESS_KEY

ENV NOVA_USERNAME=$NOVA_USERNAME
ENV NOVA_PASSWORD=$NOVA_PASSWORD

WORKDIR /var/www

# setup node js source will be used later to install node js
RUN curl -sL https://deb.nodesource.com/setup_16.x -o nodesource_setup.sh
RUN ["sh",  "./nodesource_setup.sh"]

# Install environment dependencies
RUN apt-get update \
        # gd
        && apt-get install -y build-essential  openssl nginx libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev zlib1g-dev libzip-dev gcc g++ make vim unzip curl git jpegoptim optipng pngquant gifsicle locales libonig-dev nodejs  \
        && docker-php-ext-configure gd  \
        && docker-php-ext-install gd \
        # gmp
        && apt-get install -y --no-install-recommends libgmp-dev \
        && docker-php-ext-install gmp \
        # pdo_mysql
        && docker-php-ext-install pdo_mysql mbstring \
        # pdo
        && docker-php-ext-install pdo \
        # opcache
        && docker-php-ext-enable opcache \
        # exif
    && docker-php-ext-install exif \
    && docker-php-ext-install sockets \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install bcmath \
        # zip
        && docker-php-ext-install zip \
        && apt-get autoclean -y \
        && rm -rf /var/lib/apt/lists/* \
        && rm -rf /tmp/pear/

# Copy files
COPY . /var/www

COPY local.ini /usr/local/etc/php/local.ini

COPY nginx.conf /etc/nginx/nginx.conf

RUN chmod +rwx /var/www

RUN chmod -R 755 /var/www

# setup FE
RUN npm install

RUN npm rebuild node-sass

RUN npm run prod

# setup composer and laravel
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer config http-basic.nova.laravel.com "${NOVA_USERNAME}" "${NOVA_PASSWORD}"

RUN composer require s-ichikawa/laravel-sendgrid-driver:3.0.4
RUN composer require laravel/horizon --ignore-platform-reqs
RUN php artisan horizon:install
RUN composer install --working-dir="/var/www" --prefer-dist --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

RUN composer dump-autoload --working-dir="/var/www"
COPY .env.example /var/www/.env

RUN php artisan storage:link

RUN php artisan optimize

RUN php artisan route:clear

RUN php artisan route:cache

RUN php artisan config:clear

RUN php artisan config:cache

RUN php artisan view:clear

RUN php artisan view:cache

RUN chmod -R 777 /var/www/storage
RUN chmod -R 777 /var/www/bootstrap

EXPOSE 80

RUN ["chmod", "+x", "post_deploy.sh"]

CMD [ "sh", "./post_deploy.sh" ]
# CMD php artisan serve --host=127.0.0.1 --port=9000

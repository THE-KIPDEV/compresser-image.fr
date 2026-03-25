FROM php:8.3-fpm-alpine

# Install extensions + GD for image compression
RUN apk add --no-cache nginx curl \
        freetype-dev libjpeg-turbo-dev libpng-dev libwebp-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install pdo pdo_mysql opcache gd intl

# OPcache config
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/opcache.ini

# PHP config — allow 50MB uploads for Pro users
RUN echo "upload_max_filesize = 50M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "post_max_size = 55M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini

# Nginx template (PORT substituted at runtime)
COPY nginx.conf /etc/nginx/http.d/default.conf.template

# Application
WORKDIR /var/www/html
COPY . /var/www/html/

# Create uploads directory
RUN mkdir -p /var/www/html/uploads && \
    chown -R www-data:www-data /var/www/html

# Start script — substitute PORT then launch PHP-FPM + Nginx
RUN printf '#!/bin/sh\n\
export PORT=${PORT:-8080}\n\
sed "s/listen 8080/listen $PORT/" /etc/nginx/http.d/default.conf.template > /etc/nginx/http.d/default.conf\n\
php-fpm -D\n\
nginx -g "daemon off;"\n' > /start.sh && \
    chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]

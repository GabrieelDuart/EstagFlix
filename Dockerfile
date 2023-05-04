FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt update && \
    apt install apache2 -y && \
    apt install php8.1 php8.1-mysqli -y && \
    rm /var/www/html/index.html && \
    apt clean

WORKDIR /var/www/html
COPY app .

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN apt install unzip -y
RUN composer require vlucas/phpdotenv

EXPOSE 8000

CMD ["apache2ctl", "-D","FOREGROUND"]

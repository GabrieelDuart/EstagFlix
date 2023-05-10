FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt update && \
    apt install apache2 -y && \
    apt install php8.1 php8.1-mysqli -y && \
    rm /var/www/html/index.html && \
    apt clean

WORKDIR /var/www/html
COPY app .

EXPOSE 80

CMD ["apache2ctl", "-D","FOREGROUND"]

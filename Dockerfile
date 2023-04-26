FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt update 
RUN apt install apache2 -y
RUN apt install php8.1 -y
RUN apt clean

COPY . /var/www/html/estagflix
RUN rm /var/www/html/index.html
COPY 000-default.conf etc/apache2/sites-available

EXPOSE 80

CMD ["apache2ctl", "-D","FOREGROUND"]


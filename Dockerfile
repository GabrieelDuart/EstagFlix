FROM httpd:latest

WORKDIR /usr/local/apache2/htdocs/

COPY . ./estagflix
COPY httpd.conf /usr/local/apache2/conf

RUN sudo apt install php8.1

EXPOSE 80
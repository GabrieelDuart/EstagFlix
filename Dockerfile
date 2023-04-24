FROM httpd:latest

WORKDIR /usr/local/apache2/htdocs/

COPY . ./estagflix
COPY httpd.conf /usr/local/apache2/conf

EXPOSE 80
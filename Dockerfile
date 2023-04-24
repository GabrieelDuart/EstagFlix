FROM httpd:latest

WORKDIR /usr/local/apache2/htdocs/
COPY . ./estagflix

EXPOSE 80
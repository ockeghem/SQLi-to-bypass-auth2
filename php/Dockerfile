FROM php:8.2.10-apache
WORKDIR /var/www
COPY ./init.* .
RUN apt update \
    && apt install -y sqlite3 \
    && sqlite3 db.sqlite3 ".read init.sql" \
    && php init.php \
    && chown -R www-data:www-data /var/www

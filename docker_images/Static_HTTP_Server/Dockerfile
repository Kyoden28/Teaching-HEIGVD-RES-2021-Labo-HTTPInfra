FROM php:8.0-apache

LABEL maintainer="christian.gomes@heig-vd.ch"

RUN apt-get update && \
	apt-get install -y vim

EXPOSE 80

COPY /src /var/www/html


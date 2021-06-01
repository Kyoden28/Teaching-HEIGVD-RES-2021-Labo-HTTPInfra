FROM php:8.0-apache

LABEL maintainer="christian.gomes@heig-vd.ch"

RUN apt-get update && \
	apt-get install -y vim

#COPY apache2-foreground /usr/local/bin/

COPY conf/ /etc/apache2

RUN a2enmod proxy proxy_http
RUN a2ensite 000-* 001-*


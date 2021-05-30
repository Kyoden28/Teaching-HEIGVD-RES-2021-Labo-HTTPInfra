FROM php:8.0-apache

LABEL maintainer="christian.gomes@heig-vd.ch"

COPY conf/ /etc/apache2

RUN a2enmod proxy proxy_http
RUN a2ensite 000-* 001-*


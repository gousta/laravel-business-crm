FROM phpdockerio/php7-fpm:latest

ENV DEBIAN_FRONTEND noninteractive

RUN ln -sf /usr/share/zoneinfo/Europe/Athens /etc/localtime

RUN apt-get update

RUN apt-get install -y --no-install-recommends locales
RUN apt-get install -y --no-install-recommends apt-transport-https
RUN apt-get install -y --no-install-recommends software-properties-common
RUN apt-get install -y --no-install-recommends apt-utils

RUN apt-get install -y --no-install-recommends php-common
RUN apt-get install -y --no-install-recommends php-redis
RUN apt-get install -y --no-install-recommends php7.0-dba
RUN apt-get install -y --no-install-recommends php7.0-gd
RUN apt-get install -y --no-install-recommends php7.0-gmp
RUN apt-get install -y --no-install-recommends php7.0-imap
RUN apt-get install -y --no-install-recommends php7.0-intl
RUN apt-get install -y --no-install-recommends php7.0-odbc
RUN apt-get install -y --no-install-recommends php7.0-xmlrpc
RUN apt-get install -y --no-install-recommends php7.0-pgsql

RUN phpenmod pgsql

RUN sed -i 's/# el_GR.UTF-8 UTF-8/el_GR.UTF-8 UTF-8/' /etc/locale.gen && locale-gen
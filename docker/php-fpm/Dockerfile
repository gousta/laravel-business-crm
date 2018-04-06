FROM phpdockerio/php71-fpm:latest

ENV DEBIAN_FRONTEND noninteractive

RUN ln -sf /usr/share/zoneinfo/Europe/Athens /etc/localtime

RUN apt-get update 

RUN apt-get install -y --no-install-recommends locales && sed -i 's/# el_GR.UTF-8 UTF-8/el_GR.UTF-8 UTF-8/' /etc/locale.gen && locale-gen

RUN apt-get install -y --no-install-recommends apt-utils

RUN apt-get install -y --no-install-recommends php-redis php7.1-bcmath php7.1-bz2 php7.1-dba php7.1-gd php7.1-gmp php7.1-imap php-imagick php7.1-intl php-mongodb php7.1-odbc php7.1-xmlrpc php-yaml

RUN apt-get install -y --no-install-recommends php7.1-pgsql && phpenmod pgsql
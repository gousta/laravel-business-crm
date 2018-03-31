FROM phpdockerio/php71-fpm:latest

RUN apt-get update

RUN apt-get -y --no-install-recommends install php-redis php7.1-bcmath php7.1-bz2 php7.1-dba php7.1-gd php7.1-gmp php7.1-imap php-imagick php7.1-intl php-mongodb php7.1-odbc php7.1-xmlrpc php-yaml

RUN apt-get -y install php7.1-pgsql && phpenmod pgsql
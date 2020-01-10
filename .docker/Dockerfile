FROM php:7.3-apache

ENV ACCEPT_EULA=Y

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN curl -sS https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
RUN curl -sS https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list

RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    libaio1 \
    zlib1g-dev \
    libzip-dev \
    libpq-dev \
    unixodbc-dev \
    msodbcsql17 \
    git \
    unzip \
    wget \
    vim \
    nodejs \
    yarn

RUN mkdir /opt/oracle \
    && cd /opt/oracle \
    && wget https://download.oracle.com/otn_software/linux/instantclient/195000/instantclient-basic-linux.x64-19.5.0.0.0dbru.zip \
    && wget https://download.oracle.com/otn_software/linux/instantclient/195000/instantclient-sdk-linux.x64-19.5.0.0.0dbru.zip \
    && unzip /opt/oracle/instantclient-basic-linux.x64-19.5.0.0.0dbru.zip -d /opt/oracle \
    && unzip /opt/oracle/instantclient-sdk-linux.x64-19.5.0.0.0dbru.zip -d /opt/oracle \
    && ln -s /opt/oracle/instantclient_19_5 /opt/oracle/instantclient \
    && rm -Rf /opt/oracle/*.zip

ENV LD_LIBRARY_PATH /opt/oracle/instantclient

RUN docker-php-ext-configure pdo_oci --with-pdo-oci=instantclient,/opt/oracle/instantclient,19.5 \
    && echo 'instantclient,/opt/oracle/instantclient' | pecl install oci8 \
    && docker-php-ext-install pdo_oci pdo_mysql pdo_pgsql mysqli \
    && docker-php-ext-enable oci8

RUN pecl install sqlsrv pdo_sqlsrv xdebug \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./000-default.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/html

RUN a2enmod rewrite

EXPOSE 80

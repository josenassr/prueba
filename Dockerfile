# Use an official PHP image with Apache as the base image.
FROM php:8.3-apache

# Set environment variables.
ENV ACCEPT_EULA=Y

# Set main params
ARG BUILD_ARGUMENT_DEBUG_ENABLED=false
ENV DEBUG_ENABLED=$BUILD_ARGUMENT_DEBUG_ENABLED
ARG BUILD_ARGUMENT_ENV=dev
ENV ENV=$BUILD_ARGUMENT_ENV
ENV APP_HOME /var/www/html
ARG UID=1000
ARG GID=1000
ENV USERNAME=www-data

# Update and install necessary packages
RUN apt-get update && apt-get install -y \
    vim \
    software-properties-common \
    curl \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache modules required for Laravel.
RUN a2enmod rewrite

# Install PHP extensions.
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql 

# Clean Apt cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Disable default site and delete all default files inside APP_HOME
RUN a2dissite 000-default.conf && rm -r $APP_HOME

# Create document root and necessary directories
RUN mkdir -p $APP_HOME && \
    mkdir -p /home/$USERNAME && \
    usermod -u $UID $USERNAME -d /home/$USERNAME && \
    groupmod -g $GID $USERNAME && \
    chown -R ${USERNAME}:${USERNAME} $APP_HOME

# Create locale directory
RUN mkdir -p $APP_HOME/locale && \
    chown -R ${USERNAME}:${USERNAME} $APP_HOME/locale

# Put apache and php config for Laravel, enable sites
COPY ./docker/general/laravel.conf /etc/apache2/sites-available/laravel.conf
RUN a2ensite laravel.conf 
COPY ./docker/$BUILD_ARGUMENT_ENV/php.ini /usr/local/etc/php/php.ini

# Enable apache modules
RUN a2enmod rewrite
RUN a2enmod ssl

# Install Composer globally.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create a directory for your Laravel application.
WORKDIR /var/www/html

# Set permissions for Apache to serve the files.
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html

# Generate certificates
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/ssl-cert-snakeoil.key -out /etc/ssl/certs/ssl-cert-snakeoil.pem -subj "/C=AT/ST=Vienna/L=Vienna/O=Security/OU=Development/CN=example.com"

# Switch to www-data user
USER ${USERNAME}

# Start Apache web server.
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
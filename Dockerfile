FROM php:5.5.38

WORKDIR /var/www

# Install dependencies
RUN apt-get update
RUN apt-get install -y \
    build-essential \
    locales \
    zip \
    vim \
    unzip \
    curl \
    libzip-dev \
    libxml2-dev

RUN docker-php-ext-install soap

# Copy existing application directory contents
COPY . /var/www

CMD ["sh"]

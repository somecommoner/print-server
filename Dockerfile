FROM php:8-apache

RUN apt-get update && apt-get install -y \
  --no-install-recommends \
  supervisor \
  cron \
  openssh-server \
  unixodbc-dev \
  gnupg \
  unzip \
  git \
  sudo \
  wget

RUN docker-php-ext-install pdo_mysql && \
  a2enmod rewrite
 
COPY Framework /var/www/html

RUN chown -R www-data:www-data /var/www/html && \
  echo "root:Docker!" | chpasswd  && \
  mkdir -p -m0755 /var/run/sshd

RUN cd /var/www/html && \
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
  php composer-setup.php && \
  php -r "unlink('composer-setup.php');" && \
  mv composer.phar composer && \
  cp composer /tmp

COPY rootfs /

WORKDIR /var/www/html

EXPOSE 2222

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

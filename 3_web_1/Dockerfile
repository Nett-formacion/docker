FROM ubuntu:latest
ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt install -y apache2 \
    vim \
    less \
    php \
    libapache2-mod-php
RUN apt install -y\
    mysql-client\
    mysql-server
RUN ln -snf /usr/share/zoneinfo/Europe/Madrid  \
    /etc/localtime \
    && echo Europe/Madrid > /etc/timezone
LABEL zona_horaria="Madrid/Europa"
LABEL maintainer="Manuel Romero"
LABEL description="Contenedor con apache y php"

RUN service apache2 start
RUN service mysql start
RUN apt-get install -y phpmyadmin

ENV WEB_PORT=80
EXPOSE $WEB_PORT
VOLUME /var/www/html
CMD ["sh", "-c", "service apache2 start && tail -f /dev/null"]


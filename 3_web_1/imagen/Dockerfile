FROM ubuntu:latest
ARG DEBIAN_FRONTEND=noninteractive

# Instalar paquetes
RUN apt-get update && apt install -y apache2 \
    vim \
    less \
    php \
    libapache2-mod-php \
    mysql-client \
    mysql-server

RUN ln -snf /usr/share/zoneinfo/Europe/Madrid \
    /etc/localtime \
    && echo Europe/Madrid > /etc/timezone

LABEL zona_horaria="Madrid/Europa"
LABEL maintainer="Manuel Romero"
LABEL description="Contenedor con apache y php"

# Iniciar servicios
RUN service apache2 start
RUN service mysql start

# Instalar PHPMyAdmin
RUN apt-get install -y phpmyadmin

# Realizo en enlace simbólic
RUN ln -s /usr/share/phpmyadmin/ /var/www/html

# Crear usuario MySQL
RUN service mysql start \
    && mysql -e "CREATE USER 'phpmyadmin_user'@'%' IDENTIFIED BY 'phpmyadmin_password';" \
    && mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'phpmyadmin_user'@'%' WITH GRANT OPTION;" \
    && mysql -e "FLUSH PRIVILEGES;" \
    && service mysql stop

# Configurar PHPMyAdmin
RUN sed -i 's/localhost/127.0.0.1/g' /etc/phpmyadmin/config-db.php

ENV WEB_PORT=80
EXPOSE $WEB_PORT
VOLUME /var/www/html
CMD ["sh", "-c", "service apache2 start && tail -f /dev/null"]

FROM ubuntu:latest
RUN apt-get update
RUN apt-get -y install apache2
RUN apt-get  -y install vim
RUN apt-get -y install net-tools
RUN apt-get -y install iputils-ping



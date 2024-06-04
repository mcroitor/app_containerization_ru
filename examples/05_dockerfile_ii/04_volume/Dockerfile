FROM debian

RUN apt-get update && apt-get install -y apache2

EXPOSE 80

VOLUME /var/www/html

CMD ["apache2ctl", "-D", "FOREGROUND"]


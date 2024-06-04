# Вопросы по теме "Запуск контейнеризированных приложений"

Вопросы типа _"короткий ответ"_:

1. Чтобы собрать образ `myimage` из `Dockerfile`, необходимо выполнить команду:
   - `docker build -t myimage .`
   - `docker build --tag myimage .`
2. Чтобы собрать образ `webserver` из `Dockerfile.nginx`, необходимо выполнить команду:
   - `docker build -t webserver -f Dockerfile.nginx .`
   - `docker build -t webserver --file Dockerfile.nginx .`
   - `docker build --tag webserver -f Dockerfile.nginx .`
   - `docker build --tag webserver --file Dockerfile.nginx .`
   - `docker build --file Dockerfile.nginx --tag webserver .`
   - `docker build -f Dockerfile.nginx --tag webserver .`
   - `docker build --file Dockerfile.nginx -t webserver .`
   - `docker build -f Dockerfile.nginx -t webserver .`
3. Чтобы собрать образ `sample` с тегом `1.0` из `Dockerfile`, необходимо выполнить команду:
   - `docker build -t sample:1.0 .`
   - `docker build --tag sample:1.0 .`
4. Чтобы собрать образ `sample` из `Dockerfile`, который находится в папке `php-fpm`, необходимо выполнить команду:
   - `docker build -t sample:1.0 php-fpm`
   - `docker build --tag sample:1.0 php-fpm`
   - `docker build -t sample:1.0 ./php-fpm`
   - `docker build --tag sample:1.0 ./php-fpm`
   - `docker build -t sample:1.0 php-fpm/`
   - `docker build --tag sample:1.0 php-fpm/`
   - `docker build -t sample:1.0 ./php-fpm/`
   - `docker build --tag sample:1.0 ./php-fpm/`
5. Для просмотра списка существующих образов используется команда:
   - `docker images`
6. Для удаления образа `sample` используется команда:
   - `docker rmi sample`
7. Для удаления образов `sample` и `webserver` используется команда:
   - `docker rmi sample webserver`
   - `docker rmi webserver sample`
8. Для создания контейнера `mycontainer` на базе образа `myimage` используется команда:
   - `docker create --name mycontainer myimage`
9. Для запуска контейнера `mycontainer` используется команда:
   - `docker start mycontainer`
10. Чтобы создать на базе образа `mariadb` контейнер с произвольным именем и сразу его запустить, используется команда:
    - `docker run mariadb`
11. Чтобы создать на базе образа `mariadb` контейнер с именем `mydb` и сразу его запустить, используется команда:
    - `docker run --name mydb mariadb`
12. Чтобы создать на базе образа `nginx` контейнер с именем `web` и сразу его запустить в фоновом режиме, используется команда:
    - `docker run --name web -d nginx`
    - `docker run -d --name web nginx`
13. Просмотреть список запущенных контейнеров можно с помощью команды:
    - `docker ps`
14. Просмотреть список всех контейнеров можно с помощью команды:
    - `docker ps -a`
15. Выполнить команду `/etc/init.d/nginx reload` внутри работающего контейнера `nginx` можно с помощью команды:
    - `docker exec nginx /etc/init.d/nginx reload`
16. Выполнить команду `php /var/www/html/cli/cleancache.php` внутри работающего контейнера `php-fpm` можно с помощью команды:
    - `docker exec php-fpm php /var/www/html/cli/cleancache.php`
17. Для запуска приложения `bash` внутри работающего контейнера `debian` с включенным интерактивным режимом используется команда:
    - `docker exec -it debian bash`
    - `docker exec -i -t debian bash`
    - `docker exec -t -i debian bash`
    - `docker exec -t -i debian bash`
    - `docker exec -ti debian bash`
18. Для остановки контейнера `mycontainer` используется команда:
    - `docker stop mycontainer`
19. Для удаления контейнера `mycontainer` используется команда:
    - `docker rm mycontainer`
20. Перезапустить контейнер `mc` можно с помощью команды:
    - `docker restart mc`
21. Для просмотра журналов контейнера `php-fpm` используется команда:
    - `docker logs php-fpm`
22. Для просмотра журналов контейнера `mysql` в режиме `follow` используется команда:
    - `docker logs -f mysql`
    - `docker logs --follow mysql`
23. Чтобы скопировать файл `index.html` из папки `/var/www/html` контейнера `web` в локальную директорию `./html`, используется команда:
    - `docker cp web:/var/www/html/index.html ./html`
    - `docker cp web:/var/www/html/index.html ./html/`
    - `docker cp web:/var/www/html/index.html html/`
    - `docker cp web:/var/www/html/index.html html`
24. Чтобы скопировать файл `index.html` из локальной директории `./html` в папку `/var/www/html` контейнера `web`, используется команда:
    - `docker cp ./html/index.html web:/var/www/html`
    - `docker cp ./html/index.html web:/var/www/html/`
    - `docker cp html/index.html web:/var/www/html`
    - `docker cp html/index.html web:/var/www/html/`
25. Запустить контейнер на базе образа `myserver` с запуском команды `/bin/sh` можно с помощью команды:
    - `docker run -it myserver /bin/sh`
    - `docker run -i -t myserver /bin/sh`
    - `docker run -t -i myserver /bin/sh`
    - `docker run -ti myserver /bin/sh`

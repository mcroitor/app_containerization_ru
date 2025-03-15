# Вопросы по теме "Запуск контейнеризированных приложений"

Вопросы типа _"single choice"_:

1. Какая команда используется для построения образа?
  [x] `docker image build`
  [ ] `docker create`
  [ ] `docker image run`
  [ ] `docker image start`
2. Какая команда используется для отображения списка существующих образов?
  [x] `docker image ls`
  [ ] `docker image show`
  [ ] `docker view`
  [ ] `docker list`
3. Какая команда используется для удаления образа?
  [x] `docker image rm`
  [ ] `docker delete`
  [ ] `docker remove`
  [ ] `docker remove image`
4. Какая команда используется для создания контейнера?
  [x] `docker container create`
  [ ] `docker image build`
  [ ] `docker container build`
  [ ] `docker container start`
5. Какая команда используется для запуска существующего контейнера?
  [x] `docker container start`
  [ ] `docker container run`
  [ ] `docker container create`
  [ ] `docker container build`
6. При помощи какой команды можно взаимодействовать с контейнером
  [x] `docker container exec`
  [ ] `docker container run`
  [ ] `docker container start`
  [ ] `docker container stop`
7. Какой командой можно перезапустить контейнер?
  [x] `docker container restart`
  [ ] `docker container start`
  [ ] `docker container run`
  [ ] `docker container stop`
8. Какой командой можно переписать файл в контейнер?
  [x] `docker container cp`
  [ ] `docker container mv`
  [ ] `docker container copy`
  [ ] `docker container move`
9. Какая команда используется для чтения логов контейнера?
  [x] `docker container logs`
  [ ] `docker container show`
  [ ] `docker container view`
  [ ] `docker container list`
10. Какая команда используется для просмотра списка контейнеров?
  [x] `docker container ls`
  [ ] `docker ls container`
  [ ] `docker container view`
  [ ] `docker image list`
11. Какая команда используется для остановки контейнера?
  [x] `docker container stop`
  [ ] `docker stop container`
  [ ] `docker container remove`
  [ ] `docker container delete`
12. Какая команда используется для удаления контейнера?
  [x] `docker container rm`
  [ ] `docker remove container`
  [ ] `docker container delete`
  [ ] `docker container prune`
13. Пусть дан файл `Dockerfile.sample`. Какая команда используется для построения образа с именем `myimage`?
  [x] `docker image build -t myimage -f Dockerfile.sample .`
  [ ] `docker image build -t myimage Dockerfile.sample`
  [ ] `docker image build --name myimage --file Dockerfile.sample .`
  [ ] `docker build -f Dockerfile.sample -t myimage`
14. Пусть дан образ `myimage:1.0`. Какая команда используется для создания контейнера с именем `mycontainer`?
  [x] `docker container create --name mycontainer myimage:1.0`
  [ ] `docker container create --name myimage:1.0 mycontainer`
  [ ] `docker create --name mycontainer myimage .`
  [ ] `docker build --name mycontainer myimage:1.0`
15. Пусть дан контейнер `mycontainer`. Какая команда используется для запуска контейнера в фоновом режиме?
  [x] `docker start -d mycontainer`
  [ ] `docker run --background mycontainer`
  [ ] `docker run -d --name mycontainer`
  [ ] `docker start -d --name mycontainer`
16. Пусть дан запущенный контейнер `mycontainer`. Какая команда используется для подключения к контейнеру с командой `/bin/bash` для взаимодействия с оболочкой?
  [x] `docker exec -it mycontainer /bin/bash`
  [ ] `docker run mycontainer /bin/bash`
  [ ] `docker start mycontainer /bin/bash`
  [ ] `docker container exec mycontainer /bin/bash`
17. Пусть дан запущенный контейнер `mycontainer`. Какая команда используется для чтения последних 50 строк журналов контейнера?
  [x] `docker logs -n 50 mycontainer`
  [ ] `docker container logs -f 50 mycontainer`
  [ ] `docker container show 50 mycontainer`
  [ ] `docker logs -f 50 mycontainer`
18. Пусть дан запущенный контейнер `mycontainer`. Какая команда используется для остановки контейнера?
  [x] `docker stop mycontainer`
  [ ] `docker container stop mycontainer`
  [ ] `docker container rm mycontainer`
  [ ] `docker container delete mycontainer`
19. Дан образ `myimage`. Какой командой можно запустить контейнер с именем `mycontainer` и перенаправлением порта `8080` на порт `80`?
  [x] `docker container run -d --name mycontainer -p 8080:80 myimage`
  [ ] `docker run -d --name mycontainer --ports 8080:80 myimage`
  [ ] `docker run --name mycontainer -p 8080 myimage`
  [ ] `docker run -d --name mycontainer --expose 8080:80 myimage`
20. Дан запущенный контейнер `mycontainer`. Какой командой можно скопировать файл `file.txt` в корень контейнера?
  [x] `docker container cp file.txt mycontainer:/`
  [ ] `docker image cp mycontainer:/file.txt .`
  [ ] `docker cp mycontainer:/file.txt /`
  [ ] `docker container write file.txt mycontainer:/file.txt`

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

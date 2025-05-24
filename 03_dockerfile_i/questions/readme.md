# Вопросы на тему "Синтаксис Dockerfile"

1. Что такое контекст сборки?
    - [x] Это директория, в которой находится файл `Dockerfile`.
    - [ ] Это директория, в которой находится файл `docker-compose.yml`.
    - [ ] Это директория, из которой выполняется команда `docker build`.
    - [ ] Это образ, который используется для сборки других образов.
2. Какой командой задается базовый образ?
    - [x] `FROM`
    - [ ] `BASE`
    - [ ] `BASE_IMAGE`
    - [ ] `BASE_IMAGE_NAME`
3. Специальная текстовая метка, указывающая, например, версию образа или его характеристики, называется
    - [x] `тегом`
    - [ ] `версией`
    - [ ] `метаданными`
    - [ ] `атрибутом`
4. При задании базового образа можно указать тег, который соответствует конкретной версии базового образа. Если тег не указан, то будет использован тег
    - [x] `latest`
    - [ ] `current`
    - [ ] `newest`
    - [ ] `recent`
5. Если базовый образ не указан, то будет использован базовый образ
    - [x] `scratch`
    - [ ] `empty`
    - [ ] `none`
    - [ ] `null`
6. Какой командой задается точка входа для запуска контейнера?
    - [x] `CMD`
    - [ ] `EXEC`
    - [ ] `RUN`
    - [ ] `START`
7. Чтобы скопировать файлы и директории из контекста сборки в файловую систему образа, используется команда:
    - [x] `COPY`
    - [ ] `MOVE`
    - [ ] `INSERT`
    - [ ] `PASTE`
8. Образ контейнера строится по умолчанию на базе описания файла
    - [x] `Dockerfile`
    - [ ] `docker-compose.yaml`
    - [ ] `docker-image.def`
    - [ ] `image.json`
9. Скачать архив по URL ссылке и записать в образ можно при помощи команды
    - [x] `ADD`
    - [ ] `COPY`
    - [ ] `GET`
    - [ ] `DOWNLOAD`
10. Выполнение некоторой команды при построении образа контейнера определяется директивой
    - [x] `RUN`
    - [ ] `EXEC`
    - [ ] `CMD`
    - [ ] `DO`
11. Определить рабочую директорию в образе можно при помощи команды
    - [x] `WORKDIR`
    - [ ] `WORK`
    - [ ] `DIR`
    - [ ] `CD`
12. Сменить пользователя в образе можно при помощи команды
    - [x] `USER`
    - [ ] `CHANGE_USER`
    - [ ] `SWITCH_USER`
    - [ ] `CHOWN`
13. Чтобы скопировать файл `php-fpm.conf` из папки `files/configs` в образ в папку `/etc/php` образа, нужно использовать команду
    - [x] `COPY files/configs/php-fpm.conf /etc/php`
    - [ ] `COPY /etc/php files/configs/php-fpm.conf`
    - [ ] `COPY /etc/php/php-fpm.conf files/configs`
    - [ ] `COPY /files/configs/php-fpm.conf /etc/php`
14. Чтобы создать директорию `/var/www` в образе, нужно использовать команду
    - [x] `RUN mkdir /var/www`
    - [ ] `COPY /var/www`
    - [ ] `CREATE /var/www`
    - [ ] `MKDIR /var/www`
15. Для установки пакета `nginx` в образе, нужно использовать команду
    - [x] `RUN apt-get install -y nginx`
    - [ ] `COPY apt-get install -y nginx`
    - [ ] `INSTALL nginx`
    - [ ] `ADD apt-get install -y nginx`
16. Чтобы выполнять команду `nginx -g "daemon off;"` при запуске контейнера, нужно использовать команду
    - [x] `CMD ["nginx", "-g", "daemon off;"]`
    - [ ] `RUN ["nginx", "-g", "daemon off;"]`
    - [ ] `START ["nginx", "-g", "daemon off;"]`
    - [ ] `EXEC ["nginx", "-g", "daemon off;"]`
17. Обновить списки пакетов и сами пакеты в образе на базе OS Ubuntu можно при помощи команды
    - [x] `RUN apt-get update && apt-get -y upgrade`
    - [ ] `RUN apt-get update`
    - [ ] `RUN apt-get -y upgrade`
    - [ ] `UPGRADE packages`
18. Разница между командами `CMD` и `ENTRYPOINT` заключается в том, что
    - [x] `CMD` позволяет переопределить команду при запуске контейнера, а `ENTRYPOINT` - нет.
    - [ ] `ENTRYPOINT` позволяет переопределить команду при запуске контейнера, а `CMD` - нет.
    - [ ] `CMD` и `ENTRYPOINT` выполняют одни и те же действия.
    - [ ] `CMD` и `ENTRYPOINT` выполняют разные действия.

Вопросы типа _"короткий ответ"_:

1. В Dockerfile для создания образа на базе образа `ubuntu:20.04` используется команда
    - `FROM ubuntu:20.04`
2. В Dockerfile для создания образа на базе последнего созданного образа `nginx` используется команда
   - `FROM nginx`
   - `FROM nginx:latest`
3. В Dockerfile для создания образа на базе пустого используется команда
   - `FROM scratch`
4. Какая команда в Dockerfile используется для установки пакета `nano` в образе на базе OS Ubuntu?
    - `RUN apt-get install -y nano`
    - `RUN apt-get install nano -y`
    - `RUN apt install -y nano`
    - `RUN apt install nano -y`
5. В Dockerfile для копирования файла `php.ini` из папки `files` контекста сборки в образ в папку `/etc/php/7.4/cli` используется команда
    - `COPY files/php.ini /etc/php/7.4/cli`
6. В Dockerfile для создания директории `/var/www` в образе используется команда
    - `RUN mkdir /var/www`
7. Чтобы сменить пользователя в образе на `www-data`, используется команда
    - `USER www-data`
8. Чтобы установить пакет `nginx` в образе на базе OS Ubuntu, используется команда
    - `RUN apt-get install -y nginx`
    - `RUN apt-get install nginx -y`
    - `RUN apt install -y nginx`
    - `RUN apt install nginx -y`
9. Чтобы выполнить команду `nginx -g "daemon off;"` при запуске контейнера, используется команда
    - `CMD ["nginx", "-g", "daemon off;"]`
    - `CMD nginx -g "daemon off;"`
10. Для смены рабочей директории в образе на `/var/www` используется команда
    - `WORKDIR /var/www`

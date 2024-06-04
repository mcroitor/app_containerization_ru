# Лабораторная работа: Обслуживание сервера

Целью данной работы является обучение обслуживанию Web серверов, работающих в контейнерах.

> В производстве создание резервных копий часто выполняется специализированными средствами, в данной же работы рассматривается работа менеджера задач __cron__.

> Для облегчения сбора журналов стандартной практикой является переадресация логов в стандартные потоки __STDOUT__ и __STDERR__.

## Подготовка

Проверьте, что у вас установлен и запущен _Docker Desktop_.

Создайте папку `additional`. В ней будет выполняться вся работа. Создайте папки `database` - для базы данных, `files` - для хранения конфигураций и `site` - в данной папке будет расположен сайт.

Лабораторная работа выполняется при подключении к сети Internet, так как скачиваются образы из репозитория [Docker Hub](https://hub.docker.com)

## Выполнение

Скачайте [CMS Wordpress](https://wordpress.org/) и распакуйте в папку `site`. У вас должна появиться в папке `site` папка `wordpress` с исходным кодом сайта.

### Контейнер Apache HTTP Server

Для начала создадим конфигурационный файл для Apache HTTP Server. Для этого выполните следующие команды в консоли:

```shell
# команда скачивает образ httpd и запускает на его основе контейнер с именем httpd
docker run -d --name httpd  httpd:2.4

# копируем конфигурационный файл из контейнера в папку .\files\httpd
docker cp httpd:/usr/local/apache2/conf/httpd.conf .\files\httpd\httpd.conf

# останавливаем контейнер httpd
docker stop httpd

# удаляем контейнер
docker rm httpd
```

В созданном файле `.\files\httpd\httpd.conf` раскоментируйте строки, содержащие подключение расширений `mod_proxy.so`, `mod_proxy_http.so`, `mod_proxy_fcgi.so`.

Найдите в конфигурационном файле объявление параметра `ServerName`. Под ним добавьте следующие строки:

```ini
# определение доменного имени сайта
ServerName wordpress.localhost:80
# перенаправление php запросов контейнеру php-fpm
ProxyPassMatch ^/(.*\.php(/.*)?)$ fcgi://php-fpm:9000/var/www/html/$1
# индексный файл
DirectoryIndex /index.php index.php
```

Также найдите определение параметра `DocumentRoot` и задайте ему значение `/var/www/html`, как и в следующей за параметром строке.

Создайте файл `Dockerfile.httpd` со следующим содержимым:

```dockerfile
FROM httpd:2.4

RUN apt update && apt upgrade -y

COPY ./files/httpd/httpd.conf /usr/local/apache2/conf/httpd.conf
```

Подробноcти работы с контейнером _httpd_ можно узнать здесь: [HTTPD Container](https://hub.docker.com/_/httpd).

### Контейнер PHP-FPM

Создайте файл `Dockerfile.php-fpm` со следующим содержимым:

```dockerfile
FROM php:7.4-fpm

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure pdo_mysql \
    && docker-php-ext-install -j$(nproc) gd mysqli
```

Подробноcти работы с контейнером _php_ можно узнать здесь: [PHP Container](https://hub.docker.com/_/php).

### Контейнер MariaDB

Создайте файл `Dockerfile.mariadb` со следующим содержимым:

```dockerfile
FROM mariadb:10.8

RUN apt-get update && apt-get upgrade -y
```

Подробноcти работы с контейнером _mariadb_ можно узнать здесь: [MariaDB Container](https://hub.docker.com/_/mariadb).

### Сборка решения

Создайте файл `docker-compose.yml` со следующим содержимым:

```yaml
version: '3.9'

services:
  httpd:
    build:
      context: ./
      dockerfile: Dockerfile.httpd
    networks:
      - internal
    ports:
      - "80:80"
    volumes:
      - "./site/wordpress/:/var/www/html/"
  php-fpm:
    build:
      context: ./
      dockerfile: Dockerfile.php-fpm
    networks:
      - internal
    volumes:
      - "./site/wordpress/:/var/www/html/"
  mariadb:
    build: 
      context: ./
      dockerfile: Dockerfile.mariadb
    networks:
      - internal
    environment:
     MARIADB_DATABASE: sample
     MARIADB_USER: sampleuser
     MARIADB_PASSWORD: samplepassword
     MARIADB_ROOT_PASSWORD: rootpassword
    volumes:
      - "./database/:/var/lib/mysql"
networks:
  internal: {}
```

Данный файл объявляет структуру из трех контейнеров: http как точка входа, контейнер php-fpm и контейнер с базой данных. Для взаимодействия контейнеров объявляется также сеть `internal` с настройками по умолчанию.

### Cron сервис

Для резервного копирования будем использовать контейнер _cron_, который:

1. каждые 24 часа создаёт резервную копию базы данных CMS;
2. каждый понедельник создаётся резервная копия директории CMS;
3. Каждые 24 часа удаляет резервные копии, которые были созданы 30 дней назад.
4. Каждую минуту в лог пишет сообщение _alive, \<username\>_.

Для этого в папке `./files/` создайте папку `cron`. В папке `./files/cron/` создайте папку `scripts`. В корневом каталоге создайте папку `backups`, а в ней `mysql`, `site`.

#### сообщение о статусе

В папке `./files/cron/scripts/` создайте файл `01_alive.sh` со следующим содержимым:

```shell
#!/bin/sh

echo "alive ${USERNAME}" > /proc/1/fd/1
```

Данный скрипт выдает сообщение `alive ${USERNAME}`.

#### резервное копирование сайта

В папке `./files/cron/scripts/` создайте файл `02_backupsite.sh` со следующим содержимым:

```shell
#!/bin/sh

echo "[backup] create site backup" \
    > /proc/1/fd/1 \
    2> /proc/1/fd/2
tar czfv /var/backups/site/www_$(date +\%Y\%m\%d).tar.gz /var/www/html
echo "[backup] site backup done" \
    >/proc/1/fd/1 \
    2> /proc/1/fd/2
```

Данный скрипт выдает архивирует папку `/var/www/html` и сохраняет архив в `/var/backups/site/`.

#### резервное копирование базы данных

В папке `./files/cron/scripts/` создайте файл `03_mysqldump.sh` со следующим содержимым:

```shell
#!/bin/sh

echo "[backup] create mysql dump of ${MARIADB_DATABASE} database" \
    > /proc/1/fd/1
mysqldump -u ${MARIADB_USER} --password=${MARIADB_PASSWORD} -v -h mariadb ${MARIADB_DATABASE} \
    | gzip -c > /var/backups/mysql/${MARIADB_DATABASE}_$(date +\%F_\%T).sql.gz 2> /proc/1/fd/1
echo "[backup] sql dump created" \
    > /proc/1/fd/1
```

#### удаление старых файлов

В папке `./files/cron/scripts/` создайте файл `04_clean.sh` со следующим содержимым:

```shell
#!/bin/sh

echo "[backup] remove old backups" \
    > /proc/1/fd/1 \
    2> /proc/1/fd/2
find /var/backups/mysql -type f -mtime +30 -delete \
    > /proc/1/fd/1 \
    2> /proc/1/fd/2
find /var/backups/site -type f -mtime +30 -delete \
    > /proc/1/fd/1 \
    2> /proc/1/fd/2
echo "[backup] done" \
    > /proc/1/fd/1 \
    2> /proc/1/fd/2
```

#### подготовка cron

В папке `./files/cron/scripts/` создайте файл `environment.sh` со следующим содержимым:

```shell
#!/bin/sh

env >> /etc/environment

# execute CMD
echo "Start cron" >/proc/1/fd/1 2>/proc/1/fd/2
echo "$@"
exec "$@"
```

В папке `./files/cron/` создайте файл `crontab` со следующим содержимым:

```crontab
# Example of job definition:
# .---------------- minute (0 - 59)
# |  .------------- hour (0 - 23)
# |  |  .---------- day of month (1 - 31)
# |  |  |  .------- month (1 - 12) OR jan,feb,mar,apr ...
# |  |  |  |  .---- day of week (0 - 6) (Sunday=0 or 7) OR sun,mon,tue,wed,thu,fri,sat
# |  |  |  |  |
# *  *  *  *  * user-name command to be executed
  *  *  *  *  * /scripts/01_alive.sh > /dev/null
  *  *  *  *  * /scripts/02_backupsite.sh > /dev/null
  *  *  *  *  * /scripts/03_mysqldump.sh > /dev/null
  *  *  *  *  * /scripts/04_clean.sh > /dev/null
# Don't remove the empty line at the end of this file. It is required to run the cron job
```

#### создание контейнера cron

Создайте в корневом каталоге файл `Dockerfile.cron` со следующим содержимым:

```dockerfile
FROM debian:latest

RUN apt update && apt -y upgrade && apt install -y cron mariadb-client

COPY ./files/cron/crontab /etc/cron.d/crontab
COPY ./files/cron/scripts/ /scripts/

RUN crontab /etc/cron.d/crontab

ENTRYPOINT [ "/scripts/environment.sh" ]
CMD [ "cron", "-f" ]
```

Отредактируйте файл `docker-compose.yml`, добавив после определения сервиса `mariadb` следующие строки:

```yaml
  cron:
    build:
      context: ./
      dockerfile: Dockerfile.cron
    environment:
      USERNAME: <nume prenume>
      MARIADB_DATABASE: sample
      MARIADB_USER: sampleuser
      MARIADB_PASSWORD: samplepassword
    volumes:
      - "./backups/:/var/backups/"
      - "./site/wordpress/:/var/www/html/"
    networks:
      - internal
```

Замените `<nume prenume>` на ваши имя и фамилию.

#### Ротация логов

Обратите внимание, что сборка сервера на основе контейнеров выводит логи не в файлы, а в стандартный поток вывода.

Проверьте, проанализировав файл `./files/httpd/httpd.conf`, куда выводится журнал общего назначения Apache HTTP Server? А журнал ошибок?

## Запуск и тестирование

В папке лабораторной работы откройте консоль и выполните команду:

```shell
docker-compose build
```

На основе созданных определений docker построит образы сервисов. _Сколько секунд собирался проект?_

Выполните команду:

```shell
docker-compose up -d
```

На основе образов запустятся контейнеры. Откройте в браузере страницу: http://wordpress.localhost и произведите установку сайта. __Обратите внимание, что контейнеры видят друг друга по имени, поэтому, при установке сайта надо прописывать для сервера базы данных имя хоста, равное имени контейнера, то есть `mariadb`__. Имя пользователя базы данных, его пароль и название базы данных возьмите из файла `docker-compose.yml`.

Прочите логи каждого контейнера. Для этого выполните команду

```shell
docker logs <container name>
```

Например, для созданного контейнера _cron_ логи можно прочитать следующей командой:

```shell
docker logs additional-cron-1
```

Выполните последовательно следующие команды

```shell
# остановить контейнеры
docker-compose down
# удалить контейнеры
docker-compose rm
```

Проверьте, открывается ли сайт http://wordpress.localhost . Снова запустите кластер контейнеров:

```shell
docker-compose up -d
```

и проверьте работоспособность сайта.

Подождите 2-3 минуты и проверьте, что находится в папках `./backups/mysql/`  и `./backups/site/`.

Остановите контейнеры и исправьте файл `./files/cron/crontab` таким образом, чтобы

1. каждые день в 1:00 создавалась резервная копия базы данных CMS;
2. каждый понедельник создавалась резервная копия директории CMS;
3. Каждые день в 2:00 удалялись резервные копии, которые были созданы 30 дней назад.

## Отчет

Предоставьте отчет о проделанной работе.

Ответьте на вопросы:

1. Зачем необходимо создавать пользователя системы для каждого сайта?
2. В каких случаях Web сервер должен иметь полный доступ к папкам (папке) сайта?
3. Что означает команда `chmod -R 0755 /home/www/anydir`?
4. В скриптах shell каждая команда оканчивается строкой `> /proc/1/fd/1`. Что это означает?

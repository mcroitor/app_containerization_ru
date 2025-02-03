# Вопросы по теме "Дополнительные директивы Dockerfile"

## Вопросы на выбор одного правильного варианта ответа (single choice)

1. Чтобы задать переменную окружения в образе контейнера, используется директива
    - [x] `ENV`
    - [ ] `ARG`
    - [ ] `VAR`
    - [ ] `VARIABLE`
2. Для задания аргумента сборки, который можно использовать во время сборки образа, используется директива
    - [x] `ARG`
    - [ ] `ENV`
    - [ ] `BUILD_ARG`
    - [ ] `VAR`
3. Чтобы открыть порт контейнера, используется директива
    - [x] `EXPOSE`
    - [ ] `PORT`
    - [ ] `OPEN`
    - [ ] `PUBLISH`
4. Для указания точки монтирования тома в контейнере используется директива
    - [x] `VOLUME`
    - [ ] `MOUNT`
    - [ ] `MOUNTPOINT`
    - [ ] `MOUNTVOLUME`
5. Метаданные образа можно задать с помощью директивы
    - [x] `LABEL`
    - [ ] `META`
    - [ ] `METADATA`
    - [ ] `COMMENT`
6. Сменить командную оболочку по умолчанию в образе можно с помощью директивы
    - [x] `SHELL`
    - [ ] `CMD`
    - [ ] `SH`
    - [ ] `BASH`
7. Проверить работу контейнера можно с помощью директивы
    - [x] `HEALTHCHECK`
    - [ ] `CHECK`
    - [ ] `TEST`
    - [ ] `VERIFY`
8. Задать аргумент `DEBIAN_VERSION` сборки в Dockerfile можно следующим образом:
    - [x] `ARG DEBIAN_VERSION`
    - [ ] `ENV DEBIAN_VERSION`
    - [ ] `VAR DEBIAN_VERSION`
    - [ ] `SET DEBIAN_VERSION`
9. Задать переменную окружения `DEBIAN_VERSION` в Dockerfile можно следующим образом:
    - [x] `ENV DEBIAN_VERSION`
    - [ ] `ARG DEBIAN_VERSION`
    - [ ] `VAR DEBIAN_VERSION`
    - [ ] `SET DEBIAN_VERSION`
10. Определить аргумент сборки `DEBIAN_VERSION` со значением `10` при сборке образа `myimage`, нужно использовать команду:
    - [x] `docker build --build-arg DEBIAN_VERSION=10 -t myimage .`
    - [ ] `docker build -e DEBIAN_VERSION=10 -t myimage .`
    - [ ] `docker build --arg DEBIAN_VERSION=10 -t myimage .`
    - [ ] `docker build --build-env DEBIAN_VERSION=10 -t myimage .`

## Вопросы типа _"короткий ответ"_ (short answer)

1. Чтобы задать аргумент сборки `UBUNTU_VERSION` со значением `20.04`, нужно добавить в Dockerfile следующую строку:
    - `ARG UBUNTU_VERSION=20.04`
2. Чтобы задать аргумент сборки `APP_DIR` со значением `/usr/src/app`, нужно добавить в Dockerfile следующую строку:
    - `ARG APP_DIR=/usr/src/app`
3. Чтобы задать переменную окружения `APP_DIR` со значением `/usr/src/app`, нужно добавить в Dockerfile следующую строку:
    - `ENV APP_DIR=/usr/src/app`
4. Чтобы задать переменную окружения `UBUNTU_VERSION` со значением `20.04`, нужно добавить в Dockerfile следующую строку:
    - `ENV UBUNTU_VERSION=20.04`
5. Чтобы определить аргумент сборки `UBUNTU_VERSION` со значением `20.04` при сборке образа `myimage`, нужно использовать команду:
    - `docker build --build-arg UBUNTU_VERSION=20.04 -t myimage .`
    - `docker build -t myimage --build-arg UBUNTU_VERSION=20.04 .`
6. Чтобы определить аргумент сборки `APP_DIR` со значением `/usr/src/app` при сборке образа `myimage`, нужно использовать команду:
    - `docker build --build-arg APP_DIR=/usr/src/app -t myimage .`
    - `docker build -t myimage --build-arg APP_DIR=/usr/src/app .`
7. В Dockerfile определена переменная окружения `UBUNTU_VERSION`. Напишите директиву, которая выведет значение этой переменной во время сборки образа в файл `/version.txt`.
    - `RUN echo $UBUNTU_VERSION > /version.txt`
    - `RUN echo "$UBUNTU_VERSION" > /version.txt`
    - `RUN echo ${UBUNTU_VERSION} > /version.txt`
8. В Dockerfile определён аргумент сборки `UBUNTU_VERSION`. Напишите директиву, которая определит переменную окружения `UBUNTU_VERSION` со значением аргумента сборки.
    - `ENV UBUNTU_VERSION=$UBUNTU_VERSION`
    - `ENV UBUNTU_VERSION=${UBUNTU_VERSION}`
    - `ENV UBUNTU_VERSION="$UBUNTU_VERSION"`
9. В Dockerfile определён аргумент сборки `UBUNTU_VERSION`. Напишите директиву, которая определяет создание образа на базе образа `ubuntu` с использованием аргумента сборки `UBUNTU_VERSION`.
    - `FROM ubuntu:$UBUNTU_VERSION`
    - `FROM ubuntu:${UBUNTU_VERSION}`
10. Чтобы открыть порт `80` в контейнере, нужно добавить в Dockerfile следующую строку:
    - `EXPOSE 80`
11. Чтобы открыть порт `8080` в контейнере, нужно добавить в Dockerfile следующую строку:
    - `EXPOSE 8080`
12. Чтобы пробросить порт `80` контейнера на порт `8080` хоста при создании и запуске контейнера с образом `myimage`, нужно использовать команду:
    - `docker run -p 8080:80 myimage`
13. Чтобы определить точку монтирования тома к каталогу `/data` в контейнере, нужно добавить в Dockerfile следующую строку:
    - `VOLUME /data`
14. Чтобы определить точку монтирования тома к каталогу `/var/lib/mysql` в контейнере, нужно добавить в Dockerfile следующую строку:
    - `VOLUME /var/lib/mysql`
15. Чтобы задать метаданные образа `maintainer` со значением `Gicu Stirbu`, нужно добавить в Dockerfile следующую строку:
    - `LABEL maintainer="Gicu Stirbu"`
    - `LABEL maintainer=Gicu Stirbu`
16. Чтобы задать метаданные образа `version` со значением `1.0`, нужно добавить в Dockerfile следующую строку:
    - `LABEL version="1.0"`
    - `LABEL version=1.0`

## Вопросы на написание кода (essay)

1. Напишите `Dockerfile` для образа Web сервера (Apache + PHP), запускающего Drupal, соответствующий следующим критериям:
    1. Определён аргумент сборки `UBUNTU_VERSION` со значением `22.04`
    2. Определен аргумент сборки `PHP_VERSION` со значением `7.4`
    3. Базовый образ `ubuntu` с тегом `UBUNTU_VERSION`
    4. Определена переменная окружения `PHP_VERSION` со значением аргумента сборки `PHP_VERSION`
    5. Обновлена информация о пакетах и установлены пакеты `apache2`, `php${PHP_VERSION}`, `mod-php${PHP_VERSION}`, `php${PHP_VERSION}-mysql` и `php${PHP_VERSION}-gd`
    6. Определена переменная окружения `APP_DIR` со значением `/var/www/html`
    7. Открыт порт `80` в контейнере
    8. Скопирован конфигурационный файл `apache2.conf` в каталог `/etc/apache2/` из каталога `./config/apache2/`
    9. Скопирован конфигурационный файл `php.ini` в каталог `/etc/php/${PHP_VERSION}/apache2/` из каталога `./config/php/`
    10. Скачан и распакован архив Drupal в каталог `APP_DIR` (ссылка на архив: `https://www.drupal.org/download-latest/tar.gz`)
    11. Точка входа в контейнер - `apache2 -D FOREGROUND`
2. Напишите `Dockerfile` соответствующий следующим критериям:
    1. Определён аргумент сборки `DEBIAN_VERSION` со значением `10`
    2. Определен аргумент сборки `JOOMLA_VERSION` со значением `3.10.2`
    3. Базовый образ `debian` с тегом `DEBIAN_VERSION`
    4. Определена переменная окружения `JOOMLA_VERSION` со значением аргумента сборки `JOOMLA_VERSION`
    5. Обновлена информация о пакетах и установлены пакеты `nginx`, `php-fpm`, `php-mysql` и `php-gd`
    6. Определена переменная окружения `APP_DIR` со значением `/var/www/html`
    7. Открыт порт `80` в контейнере
    8. Скопирован конфигурационный файл `nginx.conf` в каталог `/etc/nginx/` из каталога `./config/nginx/`
    9. Скопирован конфигурационный файл `php-fpm.conf` в каталог `/etc/php/${PHP_VERSION}/fpm/` из каталога `./config/php/`
    10. Скачан и распакован архив Joomla в каталог `APP_DIR` (ссылка на архив: `https://downloads.joomla.org/cms/joomla3/${JOOMLA_VERSION}/Joomla_${JOOMLA_VERSION}-Stable-Full_Package.tar.gz`)
    11. Точка входа в контейнер - `nginx -g 'daemon off;'`
3. Напишите `Dockerfile` соответствующий следующим критериям:
   1. Определен аргумент сборки `NODE_VERSION` со значением `20-alpine`
   2. Базовый образ `node` с тегом `NODE_VERSION`, именованный как `builder`
   3. Определена переменная окружения `APP_DIR` со значением `/usr/src/app`
   4. Рабочий каталог установлен в `APP_DIR`
   5. Скопирован файл `package.json` в каталог `APP_DIR` из каталога `./src`
   6. Установлены зависимости из файла `package.json` с помощью `npm install`
   7. Определен базовый образ для финального образа как `node` с тегом `NODE_VERSION`
   8. Скопированы установленные зависимости из образа `builder`, директория `node_modules` в рабочий каталог `/app` финального образа
   9. Скопированы файлы из каталога `./src` в рабочий каталог `/app` финального образа
   10. Открыт порт `3000` в контейнере
   11. Точка входа в контейнер - `node /app/index.js`
4. Напишите `Dockerfile` соответствующий следующим критериям:
    1. Определен аргумент сборки `COMPOSER_VERSION` со значением `2.7`
    2. Определен базовый образ `composer` с тегом `COMPOSER_VERSION`, именованный как `builder`
    3. Определена переменная окружения `APP_DIR` со значением `/composer`
    4. Рабочий каталог установлен в `APP_DIR`
    5. Скопирован файл `composer.json` в каталог `APP_DIR` из каталога `./site`
    6. Установлены зависимости из файла `composer.json` с помощью `composer install`
    7. Определен аргумент сборки `PHP_VERSION` со значением `8.1`
    8. Базовый образ `php` с тегом `${PHP_VERSION}-fpm`
    9. Скопированы установленные зависимости из образа `builder`, директория `vendor` в рабочий каталог `/var/www/html` финального образа
    10. Скопированы файлы из каталога `./site` в рабочий каталог `/var/www/html` финального образа
5. Напишите `Dockerfile` для образа с приложением на Python, который будет запускать веб-сервер на порту `8000`. Образ должен содержать следующие директивы:
    1. Определен аргумент сборки `PYTHON_VERSION` со значением `3.9`
    2. Базовый образ `python` с тегом `${PYTHON_VERSION}-alpine`
    3. Определена переменная окружения `DSN` со значением `sqlite:///data/app.db`
    4. Определена переменная окружения `APP_DIR` со значением `/app`
    5. Рабочий каталог установлен в `APP_DIR`
    6. Смонтирован том к каталогу `/data` в контейнере
    7. Скопирован файл `requirements.txt` в каталог `APP_DIR` из каталога `./src`
    8. Установлены зависимости из файла `requirements.txt` с помощью `pip install --no-cache-dir -r requirements.txt`
    9. Скопированы файлы из каталога `./src` в рабочий каталог `/app`
    10. Открыт порт `8000` в контейнере
    11. Точка входа в контейнер - `python /app/app.py`
6. Напишите `Dockerfile` для образа с приложением на Java, который будет запускать веб-сервер на порту `8080`. Образ должен содержать следующие директивы:
    1. Определен аргумент сборки `JAVA_VERSION` со значением `17`
    2. Базовый образ `chainguard/jdk` с тегом `openjdk-${JAVA_VERSION}`, именованный как `builder`
    3. Определена переменная окружения `APP_DIR` со значением `/app`
    4. Рабочий каталог установлен в `APP_DIR`
    5. Скопирован файл `pom.xml` в каталог `APP_DIR` из каталога `./src`
    6. Скопированы файлы из каталога `./src` в рабочий каталог `/app`
    7. Скомпилированы и упакованы файлы из каталога `/app` с помощью `mvn package`
    8. Базовый образ для финального образа - `chainguard/jre` с тегом `openjdk-${JAVA_VERSION}`
    9. Открыт порт `8080` в контейнере
    10. Скопирован файл из образа `builder`, файл `target/app.jar` в рабочий каталог `/app` финального образа
    11. Точка входа в контейнер - `java -jar /app/app.jar`

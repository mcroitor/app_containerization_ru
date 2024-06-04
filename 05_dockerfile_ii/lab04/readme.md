# Лабораторная работа №4: Запуск сайта в контейнере

## Цель работы

Выполнив данную работу студент сможет подготовить образ контейнера для запуска веб-сайта на базе Apache HTTP Server + PHP (mod_php) + MariaDB.

## Задание

Создать Dockerfile для сборки образа контейнера, который будет содержать веб-сайт на базе Apache HTTP Server + PHP (mod_php) + MariaDB. База данных MariaDB должна храниться в монтируемом томе. Сервер должен быть доступен по порту 8000.

Установить сайт WordPress. Проверить работоспособность сайта.

## Подготовка

Для выполнения данной работы необходимо иметь установленный на компьютере [Docker](https://www.docker.com/).

Для выполнения работы необходимо иметь опыт выполнения лабораторной работы №3.

## Выполнение

Создайте репозиторий `containers04` и скопируйте его себе на компьютер.

### извлечение конфигурационных файлов apache2, php, mariadb из контейнера

Создайте в папке `containers04` папку `files`, а также

- папку `files/apache2` - для файлов конфигурации apache2;
- папку `files/php` - для файлов конфигурации php;
- папку `files/mariadb` - для файлов конфигурации mariadb.

Создайте в папке `containers04` файл `Dockerfile` со следующим содержимым:

```Dockerfile
# create from debian image
FROM debian:latest

# install apache2, php, mod_php for apache2, php-mysql and mariadb
RUN apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php php-mysql mariadb-server && \
    apt-get clean
```

Постройте образ контейнера с именем `apache2-php-mariadb`.

Создайте контейнер `apache2-php-mariadb` из образа `apache2-php-mariadb` и запустите его в фоновом режиме с командой запуска `bash`.

Скопируйте из контейнера файлы конфигурации apache2, php, mariadb в папку `files/` на компьютере. Для этого, в контексте проекта, выполните команды:

```bash
docker cp apache2-php-mariadb:/etc/apache2/sites-available/000-default.conf files/apache2/
docker cp apache2-php-mariadb:/etc/apache2/apache2.conf files/apache2/
docker cp apache2-php-mariadb:/etc/php/8.2/apache2/php.ini files/php/
docker cp apache2-php-mariadb:/etc/mysql/mariadb.conf.d/50-server.cnf files/mariadb/
```

После выполнения команд в папке `files/` должны появиться файлы конфигурации apache2, php, mariadb. Проверьте их наличие. Остановите и удалите контейнер `apache2-php-mariadb`.

### Настройка конфигурационных файлов

#### Конфигурационный файл apache2

Откройте файл `files/apache2/000-default.conf`, найдите строку `#ServerName www.example.com` и замените её на `ServerName localhost`.

Найдите строку `ServerAdmin webmaster@localhost` и замените в ней почтовый адрес на свой.

После строки `DocumentRoot /var/www/html` добавьте следующие строки:

```apache
DirectoryIndex index.php index.html
```

Сохраните файл и закройте.

В конце файла `files/apache2/apache2.conf` добавьте следующую строку:

```apache
ServerName localhost
```

#### Конфигурационный файл php

Откройте файл `files/php/php.ini`, найдите строку `;error_log = php_errors.log` и замените её на `error_log = /var/log/php_errors.log`.

Настройте параметры `memory_limit`, `upload_max_filesize`, `post_max_size` и `max_execution_time` следующим образом:

```ini
memory_limit = 128M
upload_max_filesize = 128M
post_max_size = 128M
max_execution_time = 120
```

Сохраните файл и закройте.

#### Конфигурационный файл mariadb

Откройте файл `files/mariadb/50-server.cnf`, найдите строку `#log_error = /var/log/mysql/error.log` и раскомментируйте её.

Сохраните файл и закройте.

### Создание скрипта запуска

Создайте в папке `files` папку `supervisor` и файл `supervisord.conf` со следующим содержимым:

```ini
[supervisord]
nodaemon=true
logfile=/dev/null
user=root

# apache2
[program:apache2]
command=/usr/sbin/apache2ctl -D FOREGROUND
autostart=true
autorestart=true
startretries=3
stderr_logfile=/proc/self/fd/2
user=root

# mariadb
[program:mariadb]
command=/usr/sbin/mariadbd --user=mysql
autostart=true
autorestart=true
startretries=3
stderr_logfile=/proc/self/fd/2
user=mysql
```

### Создание Dockerfile

Откройте файл `Dockerfile` и добавьте в него следующие строки:

- после инструкции `FROM ...` добавьте монтирование томов:
  
```dockerfile
# mount volume for mysql data
VOLUME /var/lib/mysql

# mount volume for logs
VOLUME /var/log
```

- в инструкции `RUN ...` добавьте установку пакета `supervisor`.

- после инструкции `RUN ...` добавьте копирование и распаковку сайта WordPress:

```dockerfile
# add wordpress files to /var/www/html
ADD https://wordpress.org/latest.tar.gz /var/www/html/
```
  
- после копирования файлов WordPress добавьте копирование конфигурационных файлов apache2, php, mariadb, а также скрипта запуска:

```dockerfile
# copy the configuration file for apache2 from files/ directory
COPY files/apache2/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY files/apache2/apache2.conf /etc/apache2/apache2.conf

# copy the configuration file for php from files/ directory
COPY files/php/php.ini /etc/php/8.2/apache2/php.ini

# copy the configuration file for mysql from files/ directory
COPY files/mariadb/50-server.cnf /etc/mysql/mariadb.conf.d/50-server.cnf

# copy the supervisor configuration file
COPY files/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
```

- для функционирования mariadb создайте папку `/var/run/mysqld` и установите права на неё:

```dockerfile
# create mysql socket directory
RUN mkdir /var/run/mysqld && chown mysql:mysql /var/run/mysqld
```

- откройте порт 80.

- добавьте команду запуска `supervisord`:

```dockerfile
# start supervisor
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
```

Соберите образ контейнера с именем `apache2-php-mariadb` и запустите контейнер `apache2-php-mariadb` из образа `apache2-php-mariadb`. Проверьте наличие сайта WordPress в папке `/var/www/html/`. Проверьте изменения конфигурационного файла apache2.

### Создание базы данных и пользователя

Создайте базу данных `wordpress` и пользователя `wordpress` с паролем `wordpress` в контейнере `apache2-php-mariadb`. Для этого, в контейнере `apache2-php-mariadb`, выполните команды:

```bash
mysql
```

```sql
CREATE DATABASE wordpress;
CREATE USER 'wordpress'@'localhost' IDENTIFIED BY 'wordpress';
GRANT ALL PRIVILEGES ON wordpress.* TO 'wordpress'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### Создание файла конфигурации WordPress

Откройте в браузере сайт WordPress по адресу `http://localhost/`. Укажите параметры подключения к базе данных:

- имя базы данных: `wordpress`;
- имя пользователя: `wordpress`;
- пароль: `wordpress`;
- адрес сервера базы данных: `localhost`;
- префикс таблиц: `wp_`.

Скопируйте содержимое файла конфигурации в файл `files/wp-config.php` на компьютере.

### Добавление файла конфигурации WordPress в Dockerfile

Добавьте в файл `Dockerfile` следующие строки:

```dockerfile
# copy the configuration file for wordpress from files/ directory
COPY files/wp-config.php /var/www/html/wordpress/wp-config.php
```

## Запуск и тестирование

Пересоберите образ контейнера с именем `apache2-php-mariadb` и запустите контейнер `apache2-php-mariadb` из образа `apache2-php-mariadb`. Проверьте работоспособность сайта WordPress.

### Создание отчета

Создайте в папке `containers04` файл `README.md` который содержать пошаговое выполнение проекта. Описание проекта должно содержать:

1. Название лабораторной работы.
2. Цель работы.
3. Задание.
4. Описание выполнения работы с ответами на вопросы.
5. Выводы.

Ответьте на вопросы:

1. Какие файлы конфигурации были изменены?
2. За что отвечает инструкция `DirectoryIndex` в файле конфигурации apache2?
3. Зачем нужен файл `wp-config.php`?
4. За что отвечает параметр `post_max_size` в файле конфигурации php?
5. Укажите, на ваш взгляд, какие недостатки есть в созданном образе контейнера?

Выложите проект на GitHub.

## Представление

При представлении ответа прикрепите к заданию ссылку на репозиторий.

## Оценивание

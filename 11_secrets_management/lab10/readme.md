# Лабораторная работа №10: Управление секретами в контейнерах

## Цель работы

Целью работы является знакомство с методами управления секретами в контейнерах.

## Задание

Создать многосервисное приложение с контейнерами, использующими секреты.

## Подготовка

Для выполнения данной работы необходимо иметь установленный на компьютере [Docker](https://www.docker.com/). Работа выполняется на базе лабораторной работы `containers08`.

## Выполнение

Создайте репозиторий `containers10` и скопируйте его себе на компьютер. В папку `containers10` скопируйте содержимое проекта `containers08`.

### Настройка

Для выполнения работы используется следующий файл `docker-compose.yaml`:

```yaml
services:
  frontend:
    image: nginx:latest
    ports:
      - "80:80"
    volumes:
      - ./site:/var/www/html
      - ./nginx.conf:/etc/nginx/conf.d/default.conf
    networks:
      - frontend
  backend:
    build:
      context: .
      dockerfile: Dockerfile
    environment:
      MYSQL_HOST: database
      MYSQL_DATABASE: my_database
      MYSQL_USER: user
      MYSQL_PASSWORD_FILE: userpassword
    networks:
      - backend
      - frontend
  database:
    image: mariadb:latest
    environment:
      MYSQL_ROOT_PASSWORD: rootpassword
      MYSQL_DATABASE: my_database
      MYSQL_USER: user
      MYSQL_PASSWORD: userpassword
    networks:
      - backend
      - frontend
  database:
    image: mariadb:latest
    environment:
      MYSQL_ROOT_PASSWORD: rootpassword
      MYSQL_DATABASE: my_database
      MYSQL_USER: user
      MYSQL_PASSWORD: userpassword

networks:
  frontend: {}
  backend: {}
```

Измените класс обертку над базой данных таким образом, чтобы конструктор имел прототип:

```php
public function __construct(string $dsn, string $username, string $password);
```

Обновите файл `index.php` таким образом, чтобы он использовал новый конструктор:

```php
// $db = new Database($config["db"]["path"]);
$dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['database']};charset=utf8";

$db = new Database($dsn, $config['db']['username'], $config['db']['password']);
```

В конфигурационном файле `config.php` добавьте следующие строки:

```php
$config['db']['host'] = getenv('MYSQL_HOST');
$config['db']['database'] = getenv('MYSQL_DATABASE');
$config['db']['username'] = getenv('MYSQL_USER');
$config['db']['password'] = getenv('MYSQL_PASSWORD');
```

Обновите Dockerfile, заменив установку расширения `pdo_sqlite` на установку расширения `pdo_mysql`.

```dockerfile
FROM php:7.4-fpm AS base

# install pdo_mysql extension
RUN apt-get update && \
    apt-get install -y libzip-dev && \
    docker-php-ext-install pdo_mysql

# copy site files
COPY site /var/www/html
```

Конфигурационный файл для nginx возьмите из лабораторной работы `containers07`.

Проверьте работоспособность приложения.

### Защита секретов

Создайте папку `secrets` и добавьте в нее файлы:

- `root_secret` - пароль суперпользователя;
- `user` - имя пользователя базы данных;
- `secret` - пароль пользователя базы данных.

Пропишите содержимое данных файлов.

Обновите файл `docker-compose.yaml` таким образом, чтобы он использовал созданные секреты. Для этого добавьте секцию `secrets`:

```yaml
secrets:
  root_secret:
    file: ./secrets/root_secret
  user:
    file: ./secrets/user
  secret:
    file: ./secrets/secret
```

Для сервиса `database` обновите секцию `environment`:

```yaml
environment:
  MYSQL_ROOT_PASSWORD_FILE: /run/secrets/root_secret
  MYSQL_DATABASE: my_database
  MYSQL_USER_FILE: /run/secrets/user
  MYSQL_PASSWORD_FILE: /run/secrets/secret
```

Также обновите сервис `backend`:

```yaml
environment:
  MYSQL_HOST: database
  MYSQL_DATABASE: my_database
```

Измените содержимое конфигурационного файла `config.php` сайта следующим образом:

```php
В конфигурационном файле `config.php` добавьте следующие строки:

```php
$config['db']['host'] = getenv('MYSQL_HOST');
$config['db']['database'] = getenv('MYSQL_DATABASE');
// $config['db']['username'] = getenv('MYSQL_USER');
// $config['db']['password'] = getenv('MYSQL_PASSWORD');
$config['db']['username'] = get_file_contents('/run/secrets/user');
$config['db']['password'] = get_file_contents('/run/secrets/secret');
```

## Запуск и тестирование

Проверьте образ сервиса `containers10-backend` на их безопасность с помощью `docker scout`:

```bash
docker scout quickview containers10-backend
```

## Создание отчета

Создайте в папке `containers10` файл `README.md` который содержать пошаговое выполнение проекта. Описание проекта должно содержать:

1. Название лабораторной работы;
2. Цель работы;
3. Задание;
4. Описание выполнения работы с ответами на вопросы;
5. Выводы.

Ответьте на вопросы:

1. Почему плохо передавать секреты в образ при сборке?
2. Как можно безопасно управлять секретами в контейнерах?
3. Как использовать Docker Secrets для управления конфиденциальной информацией?

## Представление

При представлении ответа прикрепите к заданию ссылку на репозиторий.

## Оценивание

- `1 балл` - создан репозиторий `containers10`;
- `3 балл` - создана папка `site` с файлами сайта;
- `1 балл` - создана папка `secrets` для хранения секретов;
- `2 балла` - создан файл `docker-compose.yaml`;
- `1 балл` - наличие цели работы в файле `README.md`;
- `1 балл` - наличие задания в файле `README.md`;
- `2 балла` - наличие описания выполнения работы в файле `README.md`;
- `3 балла` - наличие ответов на вопросы в файле `README.md`;
- `2 балла` - наличие выводов в файле `README.md`;
- `4 балла` - защита проекта;
- `-2 балла` - за каждый день просрочки сдачи;
- `-10 баллов` - за копирование кода у других студентов.

# Лабораторная работа №9: Оптимизация образов контейнеров

## Цель работы

Целью работы является знакомство с методами оптимизации образов.

## Задание

Сравнить различные методы оптимизации образов:

- Удаление неиспользуемых зависимостей и временных файлов;
- Уменьшение количества слоев;
- Минимальный базовый образ;
- Перепаковка образа;
- Использование всех методов.

## Подготовка

Для выполнения данной работы необходимо иметь установленный на компьютере [Docker](https://www.docker.com/).

## Выполнение

Создайте репозиторий `containers09` и скопируйте его себе на компьютер. В папке `containers09` создайте папку `site` и поместите в нее файлы сайта (html, css, js).

Для оптимизации используется образ определенный следующим `Dockerfile.raw`:

```Dockerfile
# create from ubuntu image
FROM ubuntu:latest

# update system
RUN apt-get update && apt-get upgrade -y

# install nginx
RUN apt-get install -y nginx

# copy site
COPY site /var/www/html

# expose port 80
EXPOSE 80

# run nginx
CMD ["nginx", "-g", "daemon off;"]
```

Создайте его в папке `containers09` и соберите образ с именем `mynginx:raw`:

```bash
docker image build -t mynginx:raw -f Dockerfile.raw .
```

### Удаление неиспользуемых зависимостей и временных файлов

Удалите временные файлы и неиспользуемые зависимости в `Dockerfile.clean`:

```Dockerfile
# create from ubuntu image
FROM ubuntu:latest

# update system
RUN apt-get update && apt-get upgrade -y

# install nginx
RUN apt-get install -y nginx

# remove apt cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# copy site
COPY site /var/www/html

# expose port 80
EXPOSE 80

# run nginx
CMD ["nginx", "-g", "daemon off;"]
```

Соберите образ с именем `mynginx:clean` и проверьте его размер:

```bash
docker image build -t mynginx:clean -f Dockerfile.clean .
docker image list
```

### Уменьшение количества слоев

Уменьшите количество слоев в `Dockerfile.few`:

```Dockerfile
# create from ubuntu image
FROM ubuntu:latest

# update system
RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y nginx && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# copy site
COPY site /var/www/html

# expose port 80
EXPOSE 80

# run nginx
CMD ["nginx", "-g", "daemon off;"]
```

Соберите образ с именем `mynginx:few` и проверьте его размер:

```bash
docker image build -t mynginx:few -f Dockerfile.few .
docker image list
```

### Минимальный базовый образ

Замените базовый образ на `alpine` и пересоберите образ:

```Dockerfile
# create from alpine image
FROM alpine:latest

# update system
RUN apk update && apk upgrade

# install nginx
RUN apk add nginx

# copy site
COPY site /var/www/html

# expose port 80
EXPOSE 80

# run nginx
CMD ["nginx", "-g", "daemon off;"]
```

Соберите образ с именем `mynginx:alpine` и проверьте его размер:

```bash
docker image build -t mynginx:alpine -f Dockerfile.alpine .
docker image list
```

### Перепаковка образа

Перепакуйте образ `mynginx:raw` в `mynginx:repack`:

```bash
docker container create --name mynginx mynginx:raw
docker container export mynginx | docker image import - mynginx:repack
docker container rm mynginx
docker image list
```

### Использование всех методов

Создайте образ `mynginx:min` с использованием всех методов:

```Dockerfile
# create from alpine image
FROM alpine:latest

# update system, install nginx and clean
RUN apk update && apk upgrade && \
    apk add nginx && \
    rm -rf /var/cache/apk/*

# copy site
COPY site /var/www/html

# expose port 80
EXPOSE 80

# run nginx
CMD ["nginx", "-g", "daemon off;"]
```

Соберите образ с именем `mynginx:minx` и проверьте его размер. Перепакуйте образ `mynginx:minx` в `mynginx:min`:

```bash
docker image build -t mynginx:minx -f Dockerfile.min .
docker container create --name mynginx mynginx:minx
docker container export mynginx | docker image import - myngin:min
docker container rm mynginx
docker image list
```

## Запуск и тестирование

Проверьте размеры образов.

```bash
docker image list
```

Приведите таблицу с размерами образов.

## Создание отчета

Создайте в папке `containers09` файл `README.md` который содержать пошаговое выполнение проекта. Описание проекта должно содержать:

1. Название лабораторной работы;
2. Цель работы;
3. Задание;
4. Описание выполнения работы с ответами на вопросы;
5. Выводы.

Ответьте на вопросы:

1. Какой метод оптимизации образов вы считаете наиболее эффективным?
2. Почему очистка кэша пакетов в отдельном слое не уменьшает размер образа?
3. Что такое перепаковка образа?

## Представление

При представлении ответа прикрепите к заданию ссылку на репозиторий.

## Оценивание

- `1 балл` - создан репозиторий `containers09`;
- `1 балл` - создана папка `site` с файлами сайта;
- `1 балл` - создан файл `Dockerfile.raw`;
- `1 балл` - создан файл `Dockerfile.clean`;
- `2 балл` - создан файл `Dockerfile.few`;
- `1 балл` - создан файл `Dockerfile.alpine`;
- `2 балл` - создан файл `Dockerfile.min`;
- `1 балл` - наличие цели работы в файле `README.md`;
- `1 балл` - наличие задания в файле `README.md`;
- `1 балл` - наличие описания выполнения работы в файле `README.md`;
- `2 балл` - наличие ответов на вопросы в файле `README.md`;
- `2 балл` - наличие выводов в файле `README.md`;
- `4 балла` - защита проекта;
- `-1 балл` - за каждый день просрочки сдачи;
- `-5 баллов` - за копирование кода у других студентов.

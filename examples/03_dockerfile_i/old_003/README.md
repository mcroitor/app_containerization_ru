# Копирование файлов

Создайте `Dockerfile` со следующим содержимым:

```dockerfile
FROM debian:11

COPY ./script.sh .

CMD [ "./script.sh" ]
```

Соберите образ:

```shell
docker build -t appcnt:003 .
```

Будет создан образ `appcnt` с этикеткой (тагом) `003` на базе описанного `Dockerfile` файла.

Для запуска контейнера на основе созданного образа выполните команду:

```shell
docker run --name appcnt_003 appcnt:003
```

# mount sample

Два контейнера `read` и `write` монтируют один и тот же том. В контейнере `write` создается файл, контейнер `read` его читает и выводит в консоль. Контейнер `read` создается на базе файла `dockerfile.read`, контейнер `write` на базе файла `dockerfile.write`.

```bash
docker volume rm opt
docker volume ls
docker volume create opt
docker volume ls
docker image ls
docker build -t read -f dockerfile.read .
docker build -t write -f dockerfile.write .
docker image ls
docker container ls
docker run -d -v opt:/opt --name write write
docker run -d -v opt:/opt --name read read
docker container ls
```

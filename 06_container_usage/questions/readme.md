# Вопросы по теме "Взаимодействие контейнеров"

1. Просмотреть список существующих томов можно с помощью команды:
   [x] `docker volume ls`
   [ ] `docker volume list`
   [ ] `docker volume show`
   [ ] `docker volume inspect`
2. Чтобы создать том с именем `opt`, используется команда:
   [x] `docker volume create opt`
   [ ] `docker volume create --name opt`
   [ ] `docker volume make opt`
   [ ] `docker volume create name=opt`
3. Чтобы просмотреть информацию о томе `opt`, используется команда:
   [x] `docker volume inspect opt`
   [ ] `docker volume show opt`
   [ ] `docker volume info opt`
   [ ] `docker volume ls opt`
4. Удалить том `opt` можно командой:
   [x] `docker volume rm opt`
   [ ] `docker volume remove opt`
   [ ] `docker volume delete opt`
   [ ] `docker volume prune opt`
5. Удалить все неиспользуемые тома можно командой:
   [x] `docker volume prune`
   [ ] `docker volume remove`
   [ ] `docker volume clear`
   [ ] `docker volume rm`
6. Просмотреть список сетей можно с помощью команды:
   [x] `docker network ls`
   [ ] `docker network list`
   [ ] `docker network show`
   [ ] `docker network inspect`
7. Чтобы создать сеть с именем `local`, используется команда:
   [x] `docker network create local`
   [ ] `docker network make --name local`
   [ ] `docker network make local`
   [ ] `docker network create name=local`
8. Чтобы просмотреть информацию о сети `local`, используется команда:
   [x] `docker network inspect local`
   [ ] `docker network show local`
   [ ] `docker network info local`
   [ ] `docker network ls local`
9. Удалить сеть `local` можно командой:
   [x] `docker network rm local`
   [ ] `docker network remove local`
   [ ] `docker network delete local`
   [ ] `docker network prune local`
10. Подключить контейнер `frontend` к сети `local` можно командой:
   [x] `docker network connect local frontend`
   [ ] `docker network connect frontend local`
   [ ] `docker network attach frontend local`
   [ ] `docker network attach local frontend`
11. Отключить контейнер `frontend` от сети `local` можно командой:
   [x] `docker network disconnect local frontend`
   [ ] `docker network disconnect frontend local`
   [ ] `docker network detach frontend local`
   [ ] `docker network detach local frontend`
12. Удалить все неиспользуемые сети можно командой:
   [x] `docker network prune`
   [ ] `docker network remove`
   [ ] `docker network clear`
   [ ] `docker network rm`

Вопросы _короткий ответ_:

1. Для создания контейнера `webserver` на базе образа `webserver` с пробросом порта `80` контейнера на порт `8000` хоста используется команда:
   - `docker create --name webserver -p 8000:80 webserver`
   - `docker create --name webserver --port 8000:80 webserver`
   - `docker create -p 8000:80 --name webserver webserver`
   - `docker create --port 8000:80 --name webserver webserver`
2. Для создания и запуска контейнера `webserver` на базе образа `webserver` с пробросом порта `80` контейнера на порт `8080` хоста используется команда:
   - `docker run --name webserver -p 8080:80 webserver`
   - `docker run -p 8080:80 --name webserver webserver`
   - `docker run --name webserver --port 8080:80 webserver`
   - `docker run --port 8080:80 --name webserver webserver`
3. Чтобы создать и запустить контейнер `webserver` на базе образа `webserver` с монтированием тома `opt` в директорию `/opt` контейнера используется команда:
   - `docker run -v opt:/opt --name webserver webserver`
   - `docker run --volume opt:/opt --name webserver webserver`
   - `docker run --name webserver -v opt:/opt webserver`
   - `docker run --name webserver --volume opt:/opt webserver`
4. Чтобы создать и запустить контейнер `nodeapp` на базе образа `nodeapp` с монтированием тома `app` в директорию `/app` контейнера используется команда:
   - `docker run -v app:/app --name nodeapp nodeapp`
   - `docker run --volume app:/app --name nodeapp nodeapp`
   - `docker run --name nodeapp -v app:/app nodeapp`
   - `docker run --name nodeapp --volume app:/app nodeapp`
5. Чтобы создать и запустить контейнер `webserver` на базе образа `webserver` с подключением к сети `local` используется команда:
   - `docker run --name webserver --network local webserver`
   - `docker run --network local --name webserver webserver`
6. Чтобы создать и запустить контейнер `nodeapp` на базе образа `nodeapp` с подключением к сети `backend` используется команда:
   - `docker run --name nodeapp --network backend nodeapp`
   - `docker run --network backend --name nodeapp nodeapp`
7. Для удаления сети `local` используется команда:
   - `docker network rm local`
8. В Docker для создания сети с именем `local` используется команда:
   - `docker network create local`
9. Добавить контейнер `frontend` к сети `local` можно командой:
   - `docker network connect local frontend`
10. В Docker для создания тома с именем `opt` используется команда:
    - `docker volume create opt`
11. Для удаления тома `opt` используется команда:
    - `docker volume rm opt`

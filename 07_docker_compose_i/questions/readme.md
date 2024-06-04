# Вопросы по теме "Создание кластера контейнеров при помощи Docker Compose"

## Вопросы с выбором одного варианта из четырёх

1. Docker Compose это:
    - [x] инструментальное средство для описания и запуска многоконтейнерных приложений
    - [ ] инструментальное средство для описания и запуска одноконтейнерных приложений
    - [ ] сервис для управления образами контейнеров
    - [ ] сервис для управления контейнерами
2. Какой формат используется для описания многоконтейнерных приложений в Docker Compose?
    - [x] YAML
    - [ ] JSON
    - [ ] XML
    - [ ] TOML
3. Какой файл используется для описания многоконтейнерных приложений в Docker Compose?
    - [x] docker-compose.yml
    - [ ] docker-compose.xml
    - [ ] docker-compose.json
    - [ ] docker-compose.toml
4. Какой командой можно построить и запустить многоконтейнерное приложение, описанное в файле `docker-compose.yml`?
   - [x] `docker-compose up`
   - [ ] `docker-compose start`
   - [ ] `docker-compose run`
   - [ ] `docker-compose exec`
5. Какой командой можно остановить и удалить запущенное многоконтейнерное приложение?
   - [x] `docker-compose down`
   - [ ] `docker-compose stop`
   - [ ] `docker-compose stop`
   - [ ] `docker-compose rm`
6. Чтобы собрать многоконтейнерное приложение, описанное в файле `docker-compose.yml`, необходимо выполнить команду:
   - [x] `docker-compose build`
   - [ ] `docker-compose compile`
   - [ ] `docker-compose start`
   - [ ] `docker-compose run`
7. Дан файл `docker-compose.yml`:

    ```yaml
    version: '3.7'
    services:
      web:
        image: nginx:latest
        ports:
          - "8080:80"
    ```

    Какой контейнер будет запущен при выполнении команды `docker-compose up`?
    - [x] web
    - [ ] nginx
    - [ ] latest
    - [ ] не хва́тает информации для ответа
8. В файле `docker-compose.yml` необходимо обязательно указывать
    - [x] список сервисов
    - [ ] список образов
    - [ ] список сетей
    - [ ] список томов
9. Какой ключ для указания сервисов в файле `docker-compose.yml`?
    - [x] services
    - [ ] containers
    - [ ] service
    - [ ] images
10. Какой ключ для указания образа, на основе которого будет создан контейнер, в файле `docker-compose.yml`?
    - [x] image
    - [ ] container
    - [ ] service
    - [ ] images
11. Если для сервиса не указан ключ `image`, то необходимо указать ключ
    - [x] build
    - [ ] create
    - [ ] run
    - [ ] from
12. Какой ключ для указания портов, которые необходимо пробросить из контейнера в хост-систему, в файле `docker-compose.yml`?
    - [x] ports
    - [ ] expose
    - [ ] publish
    - [ ] forward
13. Для указания монтирования тома в контейнер в файле `docker-compose.yml` используется ключ
    - [x] volumes
    - [ ] mounts
    - [ ] bind
    - [ ] attach
14. Для указания используемых сетей сервисом в файле `docker-compose.yml` используется ключ
    - [x] networks
    - [ ] net
    - [ ] network
    - [ ] nets
15. Для указания очереди запуска сервисов в файле `docker-compose.yml` используется ключ
    - [x] depends_on
    - [ ] run_after
    - [ ] after
    - [ ] before
16. Для просмотра журнала событий сервиса `myservice`, описанного в файле `docker-compose.yml`, необходимо выполнить команду
    - [x] `docker-compose logs myservice`
    - [ ] `docker-compose log myservice`
    - [ ] `docker-compose journal myservice`
    - [ ] `docker-compose events myservice`
17. Для выполнения команды `command` внутри контейнера сервиса `myservice`, описанного в файле `docker-compose.yml`, необходимо выполнить команду
    - [x] `docker-compose exec myservice command`
    - [ ] `docker-compose run myservice command`
    - [ ] `docker-compose start myservice command`
    - [ ] `docker-compose stop myservice command`

## Вопросы с коротким ответом

1. Для указания версии синтаксиса Docker Compose в файле `docker-compose.yml` используется ключ
    - `version`
2. Для указания сервисов в файле `docker-compose.yml` используется ключ
    - `services`
3. Для указания образа, на основе которого будет создан контейнер, в файле `docker-compose.yml` используется ключ
    - `image`
4. Для указания портов, которые необходимо пробросить из контейнера в хост-систему, в файле `docker-compose.yml` используется ключ
    - `ports`
5. Для указания монтирования тома в контейнер в файле `docker-compose.yml` используется ключ
    - `volumes`
6. Для указания используемых сетей сервисом в файле `docker-compose.yml` используется ключ
    - `networks`
7. Для указания очереди запуска сервисов в файле `docker-compose.yml` используется ключ
    - `depends_on`
8. Для указания пути к катаогу с файлом `Dockerfile` в файле `docker-compose.yml` используется ключ
    - `build`
9. Для указания команды, которая будет выполнена при запуске контейнера, в файле `docker-compose.yml` используется ключ
    - `command`
10. Чтобы создать инфраструктуру определенную в файле `docker-compose.yml` и построить контейнеры сервисов, необходимо выполнить команду
    - `docker-compose build`
    - `docker compose build`
11. Чтобы запустить контейнеры сервисов, определённые в файле `docker-compose.yml`, необходимо выполнить команду
    - `docker-compose up`
    - `docker-compose up -d`
    - `docker compose up`
    - `docker compose up -d`
12. Чтобы остановить и удалить контейнеры сервисов, определённые в файле `docker-compose.yml`, необходимо выполнить команду
    - `docker-compose down`
    - `docker compose down`
13. Чтобы просмотреть журнал событий сервиса `myservice`, определённого в файле `docker-compose.yml`, необходимо выполнить команду
    - `docker-compose logs myservice`
    - `docker compose logs myservice`
    - `docker-compose logs -f myservice`
    - `docker compose logs -f myservice`
14. Чтобы выполнить команду `command` внутри контейнера сервиса `myservice`, определённого в файле `docker-compose.yml`, необходимо выполнить команду
    - `docker-compose exec myservice command`
    - `docker compose exec myservice command`

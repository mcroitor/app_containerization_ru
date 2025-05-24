# Лабораторная работа №2. Виртуальный сервер

Данная лабораторная работа знакомит с виртуализацией операционных систем (на примере ОС Debian) и настройкой виртуального HTTP сервера (LAMP).

## Подготовка

Скачайте дистрибутив [Debian](https://www.debian.org/distrib/) для серверов для архитектуры x64 (без графического интерфейса) и систему виртуализации (гипервизор) [QEMU](https://www.qemu.org/download/).

Установите `QEMU`. Переименуйте скачанный образ дистрибутива Debian в `debian.iso`.

## Выполнение

Создайте репозиторий `containers02` и склонируйте его себе на компьютер.

Создайте в папке `containers02` папкy `dvd` и файл `readme.md`. В папку `dvd` поместите образ ISO дистрибутива Debian.

Создайте в папке `containers02` файл `.gitignore` со следующим содержимым:

```text
# Игнорируемые файлы
*.qcow2
*.iso
*.zip
```

В консоли создайте в папке `containers02` образ диска для виртуальной машины размером `8 ГБ`, формата `qcow2`, используя утилиту `qemu-img`:

```bash
qemu-img create -f qcow2 debian.qcow2 8G
```

> Для ознакомления с дополнительными параметрами утилиты выполните команду:
>
> ```bash
> qemu-img --help
> ```

Установите ОС Debian на виртуальную машину. Для этого выполните команду:

```bash
qemu-system-x86_64 -hda debian.qcow2 -cdrom dvd/debian.iso -boot d -m 2G
```

> Дополнительные параметры можно узнать, выполнив команду:
>
> ```bash
> qemu-system-x86_64 --help
> ```

При установке используйте следующие параметры:

- Имя компьютера: `debian`;
- Хостовое имя: `debian.localhost`;
- Имя пользователя: `user`;
- Пароль пользователя: `password`;

Перезагрузите виртуальную машину. Для повторного запуска виртуальной машины выполните команду:

```bash
qemu-system-x86_64 -hda debian.qcow2 -m 2G -smp 2 -device e1000,netdev=net0 -netdev user,id=net0,hostfwd=tcp::1080-:80,hostfwd=tcp::1022-:22
```

Установите LAMP в виртуальной машине. Для переключитесь на суперпользователя и выполните команды:

```bash
su
apt update -y
apt install -y apache2 php libapache2-mod-php php-mysql mariadb-server mariadb-client unzip
```

> _Какое назначение установленных пакетов?_

Скачайте [СУБД  PhpMyAdmin](https://phpmyadmin.net/).

```bash
wget https://files.phpmyadmin.net/phpMyAdmin/5.2.2/phpMyAdmin-5.2.2-all-languages.zip
```

Скачайте [CMS Drupal](https://www.drupal.org/).

```bash
wget https://ftp.drupal.org/files/projects/drupal-11.1.1.zip
```

Проверьте наличие файлов командой `ls -l`.

Распакуйте скачанные файлы в папки:

1. СУБД PhpMyAdmin ==> `/var/www/phpmyadmin`;
2. CMS Drupal ==> `/var/www/drupal`.

```bash
mkdir /var/www
unzip phpMyAdmin-5.2.2-all-languages.zip
mv phpMyAdmin-5.2.2-all-languages /var/www/phpmyadmin
unzip drupal-11.1.1.zip
mv drupal-11.1.1 /var/www/drupal
```

Создайте через командную строку для CMS базу данных `drupal_db` и пользователя базы данных с вашим именем.

```bash
mysql -u root
```

```sql
CREATE DATABASE drupal_db;
CREATE USER 'user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON drupal_db.* TO 'user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

В папке `/etc/apache2/sites-available` создайте файл `01-phpmyadmin.conf`

```bash
nano /etc/apache2/sites-available/01-phpmyadmin.conf
```

с содержимым:

```text
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot "/var/www/phpmyadmin"
    ServerName phpmyadmin.localhost
    ServerAlias www.phpmyadmin.localhost
    ErrorLog "/var/log/apache2/phpmyadmin.localhost-error.log"
    CustomLog "/var/log/apache2/phpmyadmin.localhost-access.log" common
</VirtualHost>
```

В папке `/etc/apache2/sites-available` создайте файл `02-drupal.conf`

```bash
nano /etc/apache2/sites-available/02-drupal.conf
```

 с содержимым:

```text
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot "/var/www/drupal"
    ServerName drupal.localhost
    ServerAlias www.drupal.localhost
    ErrorLog "/var/log/apache2/drupal.localhost-error.log"
    CustomLog "/var/log/apache2/drupal.localhost-access.log" common
</VirtualHost>
```

Зарегистрируйте конфигурации, выполнив команды:

```bash
/usr/sbin/a2ensite 01-phpmyadmin
/usr/sbin/a2ensite 02-drupal
```

Добавьте в файл `/etc/hosts` строки:

```text
127.0.0.1 phpmyadmin.localhost
127.0.0.1 drupal.localhost
```

## Запуск и тестирование

В открывшемся консольном окне выполните команду `uname -a`.

> _Что выводится на экране в результате выполнения данной команды?_

Перегрузите Apache Web Server.

> _Как перегрузить Apache Web Server?_

В браузере проверьте доступность сайтов  `http://drupal.localhost:1080` и `http://phpmyadmin.localhost:1080`. Завершите установку сайтов.

## Отчет

Предоставьте отчет о проделанной работе в файле `readme.md`. Отчет должен содержать:

1. Название лабораторной работы.
2. Имя и фамилию студента, группу.
3. Дату выполнения работы.
4. Описание задачи
5. Описание выполнения работы.
6. Ответы на поставленные вопросы.
7. Выводы.

Ответьте на следующие вопросы:

1. Каким образом можно скачать файл в консоли при помощи утилиты `wget`?
2. Зачем необходимо создавать для каждого сайта свою базу и своего пользователя?
3. Как поменять доступ к системе управления БД на порт `1234`?
4. Какие преимущества, с вашей точки зрения, даёт виртуализация?
5. Для чего необходимо устанавливать время / временную зону на сервере?
6. Сколько места занимает установленная вами ОС (виртуальный диск) на хостовой машине?
7. Какие есть рекомендации по разбиению диска для серверов? Почему рекомендуется так разбивать диск?

## Представление

При представлении ответа прикрепите к заданию ссылку на репозиторий.

## Оценивание

- `1 балл` - отчет содержит постановку задачи
- `1 балл` - отчет содержит описание создания образа диска
- `1 балл` - отчет содержит описание установки ОС
- `1 балл` - отчет содержит описание установки LAMP
- `1 балл` - отчет содержит описание установки конфигурации виртуальных хостов
- `1 балл` - отчет содержит описание установки Drupal
- `1 балл` - отчет содержит описание установки PhpMyAdmin
- `1 балл` - отчет содержит ответы на вопросы
- `1 балл` - отчет содержит выводы
- `1 балл` - оформление отчета согласно требованиям (форматирование, наличие библиографии)
- `2 балла` - защита работы
- `-1 балл` - за каждый день просрочки сдачи
- `-5 баллов` - за копирование кода у других студентов

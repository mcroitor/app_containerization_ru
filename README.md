# Виртуализация и контейнеризация

Конспект курса "Виртуализация и контейнеризация". Рассчитан на 12 теоретических занятий. Для понимания материала необходимо предварительно изучить курсы "Операционные системы", "Компьютерные сети", "Базы данных".

В рамках данного курса рассматриваются основные технологии виртуализации (на базе Qemu) и контейнеризация приложений (на базе Docker). Рассматриваются основные понятия, создание виртуальных машин, создание образов, запуск контейнеров, взаимодействие с контейнерами, оркестрация контейнеров, CI / CD процессы, оптимизация образов.

По окончании курса студенты смогут:

- Понимать основные понятия виртуализации и контейнеризации;
- Создавать и настраивать виртуальные машины с использованием Qemu;
- Создавать и настраивать контейнеры с использованием Docker;
- Использовать Dockerfile для создания образов контейнеров;
- Создавать и управлять многоконтейнерными приложениями с использованием docker-compose;
- Интегрировать контейнеры в CI / CD процессы;
- Оптимизировать образы контейнеров.

Репозиторий с материалами курса доступен на [GitHub](https://github.com/mcroitor/app_containerization_ru).

- [словарь терминов](glossary.md)

## Темы

1. [Введение / История](01_intro/README.md)
2. [Виртуализация](02_virtual/README.md)
3. [Синтаксис Dockerfile](03_dockerfile_i/README.md)
4. [Запуск контейнеризированных приложений](04_docker_run/README.md)
5. [Дополнительные директивы Dockerfile](05_dockerfile_ii/README.md) 
6. [Взаимодействие с контейнером](06_container_usage/README.md)
7. [docker-compose I](07_docker_compose_i/README.md)
8. [docker-compose II](08_docker_compose_ii/README.md)
9. [Контейнеры в CI / CD процессах](09_CI_CD/README.md)
10. [Оптимизация образов](10_image_optimization/README.md)
11. [Управление секретами](11_secrets_management/README.md)
12. [Рекомендации при разработке контейнеров (best practices)](12_best_practicies/README.md)

## Дополнительные материалы

- [Дополнительные материалы](additional/readme.md)

## Примеры

- [Примеры](examples/README.md)

## Библиография

1. Маркелов А. А., __Введение в технологии контейнеров и Kubernetes__ Москва: ДМКб Пресс, 2019.
2. [Finnix, __50 вопросов по Docker, которые задают на собеседованиях, и ответы на них__, Habr.com, 2020](https://habr.com/ru/companies/southbridge/articles/528206/)
3. [1shaman, __Лучшие альтернативы для Docker__, Habr.com, 2022](https://habr.com/ru/companies/first/articles/598337/)
4. [simust, __Основы контейнеризации (обзор Docker и Podman)__, Habr.com, 2022](https://habr.com/ru/articles/659049/)
5. [Bibin Wilson, Shishir Khandelwal, __How to Reduce Docker Image Size: 6 Optimization Methods__, devopscube.com, 2022](https://devopscube.com/reduce-docker-image-size/)
6. Vaibhav Kohli, Rajdeep Dua, John Wooten, __Troubleshooting Docker__, Packt, 2017
7. [Что такое виртуализация?, AWS, aws.amazon.com](https://aws.amazon.com/ru/what-is/virtualization/)
8. [simust, Основы виртуализации (обзор), habr.com, 2022-03-28](https://habr.com/ru/articles/657677/)
9. [Система виртуализации QEMU, calculate-linux.org, 2020-01-24](https://wiki.calculate-linux.org/ru/qemu)
10. [Compose Spec, docker.com](https://github.com/compose-spec/compose-spec)

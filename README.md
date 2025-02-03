# Виртуализация и контейнеризация

Конспект курса "Виртуализация и контейнеризация". Рассчитан на 13 теоретических занятий. Для понимания материала необходимо предварительно изучить курсы "Операционные системы", "Компьютерные сети", "Базы данных".

В рамках данного курса рассматриваются основные технологии виртуализации (на базе Qemu) и контейнеризация приложений (на базе Docker). Рассматриваются основные понятия, создание виртуальных машин, создание образов, запуск контейнеров, взаимодействие с контейнерами, оркестрация контейнеров, CI / CD процессы, оптимизация образов.

Репозиторий с материалами курса доступен на [GitHub](https://github.com/mcroitor/app_containerization_ru).

- [словарь терминов](glossary.md)

## Темы

1. [Введение / История](01_intro/README.md)
2. [Виртуализация](02_virtual/README.md)
3. [Основные понятия](03_definitions/README.md)
4. [Синтаксис Dockerfile](04_dockerfile_i/README.md)
5. [Запуск контейнеризированных приложений](05_docker_run/README.md)
6. [Дополнительные директивы Dockerfile](06_dockerfile_ii/README.md) 
7. [Взаимодействие с контейнером](07_container_usage/README.md)
8. [docker-compose I](08_docker_compose_i/README.md)
9. [docker-compose II](09_docker_compose_ii/README.md)
10. [Контейнеры в CI / CD процессах](10_CI_CD/README.md)
11. [Оптимизация образов](11_image_optimization/README.md)
12. [Управление секретами](12_secrets_management/README.md)
13. [Рекомендации при разработке контейнеров (best practices)](13_best_practicies/README.md)

## Дополнительные материалы

- [Дополнительные материалы](additional/readme.md)

## Примеры

- [Примеры](examples/README.md)

## Библиография

1. Лукша Марко, __Kubernetes в действии__, Москва, 2019
2. Маркелов А. А., __Введение в технологии контейнеров и Kubernetes__ Москва: ДМКб Пресс, 2019.
3. [Finnix, __50 вопросов по Docker, которые задают на собеседованиях, и ответы на них__, Habr.com, 2020](https://habr.com/ru/companies/southbridge/articles/528206/)
4. [1shaman, __Лучшие альтернативы для Docker__, Habr.com, 2022](https://habr.com/ru/companies/first/articles/598337/)
5. [simust, __Основы контейнеризации (обзор Docker и Podman)__, Habr.com, 2022](https://habr.com/ru/articles/659049/)
6. [Bibin Wilson, Shishir Khandelwal, __How to Reduce Docker Image Size: 6 Optimization Methods__, devopscube.com, 2022](https://devopscube.com/reduce-docker-image-size/)
7. Vaibhav Kohli, Rajdeep Dua, John Wooten, __Troubleshooting Docker__, Packt, 2017
8. [kubernetes, Основы Kubernetes, kubernetes.io, 2020](https://kubernetes.io/ru/docs/tutorials/kubernetes-basics/explore/explore-intro/)

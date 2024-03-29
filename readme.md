# Упрощенный сервис с регистрацией и авторизацией

## Инструкция по запуску:
1. В локальной директории из терминала выполняем команду: 

    `git clone https://github.com/vladislavpetrov4311/vk-case.git`
2. Переходим в папку с репозиторием vk-case и из терминала запускаем: 

    `docker-compose up`

## Пример работы в Postman

### 1. localhost:9000/register

![Alt text](example/register.png)

`Реализация в файлах: register.php и Register_class.php`

### 2. localhost:9000/authorize

![Alt text](example/authorize.png)

`Реализация в файлах: authorize.php и Authorize_class.php`

### 3. localhost:9000/feed

![Alt text](example/feed.png)

`Реализация в файле: feed.php`


### На случай, если нужно просмотреть визуально Базу Данных 

1. Переходим по localhost:3000 

    `!!! Важно !!! Обратите внимание, при самом первом запуске образ mysql из docker-контейнера требует больше времени на развёртывание, поэтому после запуска приложения нужно будет немного подождать`

    ![Alt text](example/phpmyadmin.png)

2. База данных testDB, таблица User

    ![Alt text](example/db.png)


## Мои контакты

1. `E-mail: petrov_vd_4311@mail.ru`
2. `номер телефона + 7 953 495 88 73`

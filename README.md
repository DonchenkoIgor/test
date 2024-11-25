# Тестовое задание: Разработка базового CRM модуля

Этот проект реализован с использованием **Laravel** и включает функционал отправки Email через очереди, работу с внешними API и кэширование.

## Шаги для разворачивания

### 1. Клонировать репозиторий: 

        git clone https://github.com/DonchenkoIgor/test.git

### 2. Установить зависимости: 
    
        composer install

### 3. Настройка окружения:

       1. Создайте пустой файл .env и скопируйте .env.example в .env:

            cp .env.example .env
        
       2. Откройте файл .env и настройте параметры:

            - База данных:
                DB_CONNECTION=mysql
                DB_HOST=127.0.0.1
                DB_PORT=3306
                DB_DATABASE=your_database
                DB_USERNAME=your_username
                DB_PASSWORD=your_password

            - Почтовая настройка для локального тестирования (с Mailpit):
                MAIL_MAILER=smtp
                MAIL_HOST=127.0.0.1
                MAIL_PORT=1025
                MAIL_USERNAME=null
                MAIL_PASSWORD=null
                MAIL_ENCRYPTION=null
                MAIL_FROM_ADDRESS=example@example.com
                MAIL_FROM_NAME="${APP_NAME}"

### 4. Генерация ключа приложения:

        php artisan key:generate

### 5. Запуск миграций и сидеров:

       php artisan migrate --seed

### 6. Запуск сервера: 
        
        php artisan serve

        - Теперь ваше приложение доступно по адресу http://127.0.0.1:8000
           http://127.0.0.1:8000/clients  -  открытие списка пользователей
           http://127.0.0.1:8000/clients/create  -  для создания нового пользователя
           http://127.0.0.1:8000/clients/1   -  отображение профиля выбранного пользователя по id
           http://127.0.0.1:8000/clients/1/edit - редактирование профиля выбранного пользователя по id 

### 7. Запуск очереди:

        php artisan queue:work



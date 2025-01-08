## Технологии

Список технологий, использованных в проекте:
- Laravel
- Vue.js
- MySQL
- Inertia.js

## Установка

1. Клонируйте репозиторий:
    git clone https://github.com/QkProger/user_settings.git

2. Перейдите в папку проекта

3. Установите зависимости:
    Для PHP:
    composer install
    Для Node.js:
    npm install

4. Создайте файл `.env` и настройте переменные окружения:
    cp .env.example .env

5. Запустите миграции и сидеры:
    php artisan migrate
    php artisan db:seed

6. Запустите локальный сервер:
    Для Laravel:
    php artisan serve
    Для фронтенда:
    npm run dev

7. Откройте в браузере [http://127.0.0.1:8000/].

8. Данные созданного вами пользователя:
    email: test@gmail.com
    password: 12345

## Тестовое задание
Если Вы не знакомы с Laravel, то можете выполнить задачу на удобном для вас фреймворке.
Требуется сделать форк текущего репозитария, выполнить задание и прислать нам ссылку на ваш форк. 
Либо, если вы желаете использовать другой фреймворк (не Ларавел), то выполнить задание, залить код на гитхаб и прислать нам ссылку.


## Настройка проекта
Для Laravel:
- `composer install`
- `npm i`
- настроить `.env` файл
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `npm run dev`

Для других фреймворков: 
- использовать дамп БД `dump.sql`

## Дополнительная информация
Статусты заказа:
- 0 новый
- 10 подтвержден
- 20 завершен

Для верстки использовать bootstrap `/public/js/app.js`, `/public/css/app.css`

Свой js код писать в файл `/public/js/script.js` 

Свои css стили писать в файл `/public/css/style.css` 

## Техническое задание

#### Обязательно
- Создать страницу на которой выводится текущая температура в Брянске (запрос из php) (Работа с api какого-либо сервиса например: https://tech.yandex.ru/weather/)

- Создать страницу со списоком заказов в табличном виде
    - поля 
        - ид_заказа 
        - название_партнера 
        - стоимость_заказа 
        - наименование_состав_заказа 
        - статус_заказа
    - ид_заказа - ссылка на редактирование заказа в новой вкладке
- Создать страницу редактирования заказа
    - поля для редактирования:
        - email_клиента(редактирование, обязательное)
        - партнер(редактирование, обязательное)
        - продукты(вывод наименования + количества единиц продукта)
        - статус заказа(редактирование, обязательное)
        - стоимость заказ(вывод)
        - сохранение изменений в заказе

#### Не обязательно (если желаете лучше продемонстрировать свои умения)
- Создать страницу со списком продуктов в табличном виде:
    - поля 
        - ид_продукта 
        - наименование_продукта 
        - наименование_поставщика 
        - цена
    - сортировка по алфавиту по возрастанию
    - пагинация по 25 элементов
    - редактирование цены каждого продукта с помощью ajax запроса
- Дополнительный функционал для страницы списка заказов
    - список заказов разбить на вкладки(bootstrap)
        - владка просроченные
            - дата доставки раньше текущего момента
            - статус заказа 10
            - сортировка по дате доставки по убыванию
            - ограничение 50 штук
        - текущие
            - дата доставки 24 часа с текущего момента
            - статус заказа 10
            - сортировка по дате доставки по возрастанию
        - новые
            - дата доставки после текущего момента
            - статус заказа 0
            - сортировка по дате доставки по возрастанию
            - ограничение 50
        - выполненные
            - дата доставки в текущие сутки
            - статус заказа 20
            - сортировка по дате доставки по убыванию
            - ограничение 50
- Дополнительный функционал для страницы редактирования заказа
    - при установке статуса заказа "завершен" требуется отправить email - партнеру и всем поставщикам продуктов из заказа
        - заказ №(номер) завершен
        - текст состав заказа (список), стоимость заказа (значение)

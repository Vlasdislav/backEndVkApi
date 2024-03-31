# backEndVkApi (Тестовое в вк: Back-End Developer)
#### Ссылка на работающее приложение на публичном хостинге: http://budru.com.ru/backEndVkApi/api/

## /register
#### http://budru.com.ru/backEndVkApi/api/register.php
#### Входные данные
```json
{
    "email": "vladik@mail.ru",
    "password": "ko@9817hy8u"
}
```
#### Выходные данные
```json
{
    "status": true,
    "user_id": "27",
    "password_check_status": "good",
    "message": "Пользователь был создан"
}
```

## /authorize
#### http://budru.com.ru/backEndVkApi/api/authorize.php
#### Входные данные
```json
{
    "email": "vladik@mail.ru",
    "password": "ko@9817hy8u"
}
```
#### Выходные данные
```json
{
    "status": true,
    "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vYW55LXNpdGUub3JnIiwiYXVkIjoiaHR0cDovL2FueS1zaXRlLmNvbSIsImlhdCI6MTM1Njk5OTUyNCwibmJmIjoxMzU3MDAwMDAwLCJkYXRhIjp7ImlkIjoiMjciLCJlbWFpbCI6InZsYWRpa0BtYWlsLnJ1In19.p-63bniRfOKTU1gGnsMosENzSKpa1iJW2gc4Hf8hw2w",
    "message": "Успешный вход в систему"
}
```


## /feed
#### http://budru.com.ru/backEndVkApi/api/feed.php
#### Вход:
```json
{
    "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vYW55LXNpdGUub3JnIiwiYXVkIjoiaHR0cDovL2FueS1zaXRlLmNvbSIsImlhdCI6MTM1Njk5OTUyNCwibmJmIjoxMzU3MDAwMDAwLCJkYXRhIjp7ImlkIjoiMjciLCJlbWFpbCI6InZsYWRpa0BtYWlsLnJ1In19.p-63bniRfOKTU1gGnsMosENzSKpa1iJW2gc4Hf8hw2w"
}
```
#### Выход:
```json
{
    "status": true,
    "data": {
        "id": "27",
        "email": "vladik@mail.ru"
    },
    "message": "Доступ разрешен"
}
```

## Проверка надежности пароля
Для проверки пароля на подбор, использовалась большая таблица популярных паролей (всего 486976).

![table_common_password](https://github.com/Vlasdislav/backEndVkApi/raw/main/README/common_passwords.jpg)

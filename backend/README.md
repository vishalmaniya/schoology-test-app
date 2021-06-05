# Backend

Build a UI and backend for an auto complete using the backend you write as well as the frontend of your choosing. The project will break down into two parts, one for a backend and one for a frontend.

## Prerequisites
- php 7.4

## Setup

```
composer install
```

Clone env.example to .env and update db environment variables:
`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`,`DB_PASSWORD`

Clone env.example to .env and update db environment variables for backend app.

Now, we can run laravel artisan commands 
```
composer install &&
php artsan key:generate --ansi &&
php artisan migrate &&
php artisan db:seed"
```

#### Run Tests
```
./vendor/bin/phpunit
```

## Curl Commands
To test the API there are two curl commands you can run:
1. To see all the states:
```
curl --location --request GET 'http://127.0.0.1:8081/api/v1/state'
```

2. To search the state:
```
curl --location --request GET 'http://127.0.0.1:8081/api/v1/state/search?term={query}'
```
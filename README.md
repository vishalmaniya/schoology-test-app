# Schoology Test APP - Autocomplete

Build a UI and backend for an auto complete using the backend you write as well as the frontend of your choosing. The project will break down into two parts, one for a backend and one for a frontend.

## Prerequisites
- Docker

## Structure
- Backend (Laravel v.7.2)
- Frontend (React v.17.0)

## Setup

Close git repository using git clone command:
```
git clone ....
```
Build docker image and run docker container:
```
docker-compose build
docker-compose up -d
```
Clone env.example to .env and update db environment variables:
`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`,`DB_PASSWORD`

### Backend
```
cd backend 
```
Clone env.example to .env and update db environment variables for backend app.

Now, we can run laravel artisan commands inside docker environment
```
docker exec -it backed_app bash -c "cd backend &&
composer install &&
php artsan key:generate --ansi &&
php artisan migrate &&
php artisan db:seed"
```

#### Run Tests
```
docker exec -it backed_app bash -c "cd  /var/www/backend && ./vendor/bin/phpunit"
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
## Run App
You can access frontend url in the browser, http://127.0.0.1:3000
By default frontend port is 3000, unless you change you can use the same.

Search for the states name and you can find autosuggestion below your input.

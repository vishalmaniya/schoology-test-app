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
git clone git@github.com:vishalmaniya/schoology-test-app.git
```

Clone env.example to .env at root level
```
cp .env.example .env
```
Update db environment variables (you can skip this step to use default value):
`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`,`DB_PASSWORD`

Build docker image and run docker container:
```
docker-compose build && docker-compose up -d
```

### Backend
Now, lets copy .env file inside backend directory
```
cd backend && cp .env.example .env
```
Update db environment variables (you can skip this step to use default value):
`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`,`DB_PASSWORD`

Now, we can run laravel artisan commands inside docker environment
```
docker exec -it backed_app bash -c "cd backend && composer install && php artisan key:generate --ansi && php artisan migrate && php artisan db:seed"
```

If you see any error related to storage directory permission, please run
```
docker exec -it backed_app bash -c "cd  /var/www/html/backend && chown -R www-data:www-data storage && chown -R www-data:www-data bootstrap/cache && chmod -R 775 storage && chmod -R 775 bootstrap/cache"
```

#### Run Tests
```
docker exec -it backed_app bash -c "cd  /var/www/html/backend && php artisan test"
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

![Alt text](schoology_test_app.png?raw=true "Schoology Test App")

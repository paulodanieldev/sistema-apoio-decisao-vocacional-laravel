#!/bin/bash
if [ ! -e .env ]; then
    cp .env.example .env
fi

docker-compose up -d --build

docker-compose exec app composer install

docker-compose exec app php artisan key:generate

docker-compose exec app npm i

docker-compose exec app npm run dev
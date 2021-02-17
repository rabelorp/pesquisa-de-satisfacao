#!/bin/bash

echo Uploading Application Container 
docker-compose up --build -d

echo Install Dependencies
docker run --rm --interactive --tty -v $PWD/backend:/app composer install

echo Make Migrations Laravel
docker exec -it php php /var/www/html/artisan migrate

echo Container Information
docker ps -a 
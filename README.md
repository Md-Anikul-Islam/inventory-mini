
## all steps to run the project

git init

git remote add origin https://github.com/Md-Anikul-Islam/inventory-mini.git

git pull origin main

create database and name dealer in .env file

composer update

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan db:seed

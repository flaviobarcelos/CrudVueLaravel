Este projeto tem como objetivo exemplificar um CRUD utilizando VueJs para o Front-end consumindo API do back-end utilizando Laravel.

---------------------------------------------
Entrar na pasta da api

cd api

API REST para exemplo de crud de cadastro resumido de usuário.

Criar o banco de dados importando o arquivo crud_vue_laravel.sql

executar os comandos no projeto api

-- para instalar as dependencias do laravel
composer install

-- para criar as tabelas
php artisan migrate --seed

-- executar o projeto
php artisan serve


-------------------------------------------

Entrar na pasta do front

cd front

-- instalar as dependencias do projeto

npm install

-- executar o projeto

npm run dev



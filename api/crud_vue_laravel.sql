CREATE DATABASE crud_vue_laravel;

CREATE USER crud@localhost IDENTIFIED BY 'Crud@123';

GRANT ALL PRIVILEGES ON crud_vue_laravel . * TO crud@localhost;

FLUSH PRIVILEGES;
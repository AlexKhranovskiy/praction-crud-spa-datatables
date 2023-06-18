### Vocation
Practice with: SPA, Sanctum, DataTables, requests to API made by AXIOS, protection of routes using SPA

###Description
Project realizes CRUD without page reloading, using AXIOS, jQuery, DataTables. API is not protected. 
User opens http://localhost:8000, sees modal window for authentication. If user is already authenticated he sees
records from DB loaded by AXIOS request to DataTable tool. User
can add new record, edit the record which exists, delete the record. Modal windows appears without reloading
of the page and info for this windows is loaded by AXIOS from API of application.

###How to run
On your machine must be installed Node, Docker, PHP, Composer
* clone the repository
* rename project to 77
* ```docker-compose up -d```
*  ```composer update --no-scripts```
*  ```php artisan key:generate```
*  ```php artisan optimize```
* ```php artisan migrate```
* ```php artisan db:seed```
* ```php artisan serve```
* ```npm install```
* ```npm run dev```
*  ```Open in browser http://localhost:8000```

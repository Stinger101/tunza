#Tunza application backend#
this application is built using laravel 7.3. it supplies apis consumed by its various clients such as tunza_app(a flutter based mobile integration).
Steps to configure:
1. setup lamp stack on your server with php >7.3.
2. setup composer.
3. pull the repo and configure permissions.
4. copy .env.example into .env and set the values
5. run composer update and php artisan key:generate
6. set up supervisor to run cron jobs according to the laravel tutorial.
7. run php artisan migrate:seed
8. configure virtual hosts to serve your application.

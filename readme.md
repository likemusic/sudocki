#Заготовка для php проектов в докере    
добавить папку   
storage/docker/mysql
##Как создать php-cli
скопировать php-fpm файл    
заменить php-fpm на php-cli
## docker env 
https://docs.docker.com/compose/env-file/   


### запуск стоп
docker-compose up --build
docker-compose down


// laravel 
// Laravel Voyager 

фронт
https://demos.creative-tim.com/now-ui-dashboard/docs/1.0/getting-started/introduction.html#version

// фикс админки
public/vendor/tcg/voyager/resources/views/tools/database/index.blade.php
96   заменить на <form action="#" id="delete_bread_form" method="POST">


// сиды для временых записей
php artisan db:seed --class=ProductsSeeder
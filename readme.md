# Заготовка для php проектов в докере    
Добавить папку `storage/docker/mysql`

# Как создать php-cli
- скопировать `php-fpm` файл    
- заменить `php-fpm` на `php-cli`

# docker env 
https://docs.docker.com/compose/env-file/   

# запуск / стоп
```
docker-compose up --build
docker-compose down
```

# Laravel / Laravel Voyager 
## Из гита:
```
git fetch --all  && git reset --hard origin/master
```

## Фронт
https://demos.creative-tim.com/now-ui-dashboard/docs/1.0/getting-started/introduction.html#version

## Фикс админки
`public/vendor/tcg/voyager/resources/views/tools/database/index.blade.php`
96   заменить на `<form action="#" id="delete_bread_form" method="POST">`


## Сиды для временых записей
```
php artisan db:seed --class=ProductsSeeder
```

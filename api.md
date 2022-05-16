
### API LARAVEL SETUP

## Install Laravel Breeze
    https://laravel.com/docs/9.x/starter-kits#laravel-breeze
    Auth Scalfolding
        composer require laravel/breeze --dev
        php artisan breeze:install api
        npm install
        npm run dev
        php artisan migrate
## Create Models && Migration          
    php artisan make:model Article -m

## Relations Traits
    create a folder  called  Traits
    Purpose to check if the author wrote article
    Will return bolean type
        create two files inside traits
            Traits/HasAuthor.php
            Traits/ModelHelpers.php
    use the traits in both models btn Articles and User

## Create Factories && Seeders 
     php artisan make:factory  ArticleFactory
     php artisan make:seeder ArticlesSeeder
     php artisan make:seeder UsersSeeder
    php artisan migrate:fresh --seed

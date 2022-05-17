
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

## Create Controllers 
    Create two controllers Articles and Users
        php artisan make:controller API/V1/ArticleController -m Article --api
        php artisan make:controller API/V1/AuthorController
    ArticleController Methods
        - Index
        - Create  - UI
        - Store
        - Show
        - Edit    - UI
        - Update
        - Delete
## API Resource | Laravel REST API
    Creating two API resource collection 
        https://laravel.com/docs/9.x/eloquent-resources#main-content
        https://laravel.com/docs/8.x/eloquent-resources
        php artisan make:resource V1/ArticleResource
        php artisan make:resource V1/AuthorResource
        php artisan make:resource V1/ArticleCollection -c

## API Routes
    https://laravel.com/docs/8.x/sanctum#protecting-routes
    routes/api.php
    app/Providers/RouteServiceProvider.php
     localhost:post/api/articles
     localhost:test/api/V1/articles
       $this->routes(function () {
            Route::middleware('api/v1')
                ->prefix('api')
                ->group(base_path('routes/api_v1.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

     we can version control in api file

### Sanctum - Bearer Token 
    https://laravel.com/docs/9.x/sanctum
    Uncomment the middleware in app file
      'middleware' => 'auth:sanctum'
    Go to app/Http/Controllers/Auth/AuthenticatedSessionController.php and add the following code
        $user = auth()->user();
        
        return response()->json([
            'success' => true,
            'data'    => [
                'token' => $user->createToken($user->name())->plainTextToken,
                'name' => $user->name(),
            ],
            'message' => 'User logged in'
        ]);
    Comment this code  return response()->noContent();
    Go to postman  and create a Auth-login as post to generate the token 
    The error has been occured 
        { "message": "CSRF token mismatch.", "exception": "Symfony\\Component\\HttpKernel\\Exception\\HttpException", "file":
    Solution   app/Http/Middleware/VerifyCsrfToken.php , which exlude the URL
        protected $except = [
        '/api/*',
        'login'
    ];
    Do not usee the above code into production
    Second option is to run serve to create a CSRF token variable
            php artisan serve
    code this piece of code user postman in main project name under pre request script
            pm.sendRequest({
            url: 'localhost:8000/sanctum/csrf-cookie',
            method: 'GET'
        }, function(error , response, {cookies}){
        console.log(cookies)
        
        });

            pm.sendRequest({
            url: 'http://laravel-api.test/sanctum/csrf-cookie',
            method: 'GET'
        }, function(error , response, {cookies}){
        console.log(response.headers
        });

     pm.sendRequest({
    url: 'http://localhost:8000/sanctum/csrf-cookie',
    method: 'GET'
    }, function(error, response, {cookies}){
    pm.collectionVariables.set('csrf-token',cookies.get('XSRF-TOKEN'))
    });

    pm.sendRequest({
    url: 'http://localhost:8000/sanctum/csrf-cookie',
    method: 'GET'
    }, function(error, response, {
    cookies
    }) {
    pm.collectionVariables.set('csrf-token', cookies.get('XSRF-TOKEN'))
    });


### Auth user , User Resource and route 
    php artisan make:controller API/V1/UserController -i
    php artisan make:resource V1/UserResource

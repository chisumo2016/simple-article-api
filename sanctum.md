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
    Solution

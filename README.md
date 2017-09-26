# How to use it

In this example I am going to use `Laravel` https://laravel.com/ framework for my api project

## Pre-Request for the Demo

Laravel

Composer

PHP > 5.3 

## Create New Project and Getting started in Laravel 

Please visit the following links to get familar in `Laravel`

https://laravel.com/docs/5.5


### Download the sample project 

https://github.com/Cidaas/rest-api-without-secure

In this project I have some sample rest services to show the employee details.


### Accessing the Rest Api (Without secure)

Open the rest api client (ex : Postman, RestClient... ) , access the below urls

> open routes/web.php

and you will see the following routes 

```php
Route::get('/myprofile', "RestController@MyProfile");

Route::get('/employeelist', "RestController@EmployeeList");

Route::get('/holidaylist', "RestController@HolidayList");

Route::get('/localholidaylist', "RestController@LocalHolidayList");

Route::get('/leavetype', "RestController@LeaveType");
```

and if you look at the RestController , it just returning JSONs


To run the project

> php artisan serve

This will listion the endpoint in 8000 port, 


1. http://localhost:8000/myprofile

1. http://localhost:8000/employeelist

1. http://localhost:8000/holidaylist


You must see employee JSONs

## Integarating Cidaas Interceptor

Cidaas interceptor is published in packagist (https://packagist.org/packages/cidaas/cidaas-interceptor) .

### Install interceptor

> composer require cidaas/cidaas-interceptor @dev

In the sample project, open /app/Http/Kernal.php and register the middleware

##### Require the Interceptor.php


```
require(base_path() . "/vendor/cidaas/cidaas-interceptor/lib/Interceptor.php");
```
##### Add the interceptor in the routeMiddleware array.

```php

'cidaas'=> \cidaas\interceptor\lib\Interceptor::class 

```

##### After adding 

```php
 protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'cidaas'=> \cidaas\interceptor\lib\Interceptor::class
];
```

### Add the Cidaas Token Check URL

Add the `CIDAAS_USER_INFO_BY_TOKEN` in the .env file in the project 


```
CIDAAS_USER_INFO_BY_TOKEN=yourcidaasdomain/token/userinfobytoken
```

Thats it .., Interceptor installed successfully.

### Adding to the routes

> open routes/web.php

Just Change this 

```php
Route::get('/myprofile', "RestController@MyProfile");
```

To 

```php
Route::get('/myprofile',[
    "uses"=>"RestController@MyProfile"])->middleware('cidaas');
```

This will enble the secure api serving with Laravel Middleware. 


### How to use Role Validation

> open routes/web.php

Just Change this 

```php
Route::get('/employeelist', "RestController@EmployeeList");
```

To

```php
Route::get('/employeelist',[ 
    "roles"=>["HR"],
    "uses"=>"RestController@EmployeeList"])->middleware('cidaas');
```

### How to use Scope Validation

> open routes/web.php

Just Change this 

```php
Route::get('/holidaylist', "RestController@HolidayList");
```

To

```php
Route::get('/holidaylist',[
    "roles"=>["HR"],
    "scopes"=>["holidaylist:read"],
    "uses"=>"RestController@HolidayList"])->middleware('cidaas');
```


Now the Rest services fully secured with Cidaas Interceptors






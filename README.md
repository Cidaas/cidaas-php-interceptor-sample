# How to use it

In this example we are going to use `Laravel` https://laravel.com/ framework for my api project

## Pre-Request for the Demo

Laravel

Composer

PHP > 5.3 

## Getting started with Laravel 

Please visit the following links to get familar in `Laravel`

https://laravel.com/docs/5.5


### Download the sample project 

https://github.com/Cidaas/cidaas-php-interceptor-sample

In this project we have sample rest services to show the employee details.


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

## Integrating Cidaas Interceptor

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

### To Generate Access Token

Use our OAuth2 Client Library to get access token from Cidaas

https://github.com/Cidaas/oauth2-cidaas-php

### Access the secured rest API with access token

Cidaas interceptor expecting the client to pass the access token in all the requests, in the `header` or `query string` with the key of `access_token` or in the `authorization header` with `bearer token` 

Sample Request 


```php
curl -X GET \
  http://localhost:8000/employeelist \
  -H 'access_token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJkYjM4NDUyYS00ODA4LTQ4NGItODZhOS1lYjk0MDcxYmM4OTMiLCJhdWQiOiJlNWYzNjAxZWZmMDY0ZTllYmIxYjViY2QxYWRlMDAyNyIsImNsaWVudGlkIjoiZTVmMzYwMWVmZjA2NGU5ZWJiMWI1YmNkMWFkZTAwMjciLCJyb2xlIjoiSFIsVVNFUiIsImF1dGhfdGltZSI6MTUwNjM2ODcwODk2OSwic2NvcGUiOiJjaWRhYXM6dXNlcmluZm8gYWRkcmVzcyBwaG9uZSBwcm9maWxlIGNpZGFhczpsb2dpbiBjaWRhYXM6cmVnaXN0ZXIgY2lkYWFzOnVzZXJ1cGRhdGUgZW1haWwiLCJpc3MiOiJodHRwczovL2RlbW8uY2lkYWFzLmRlIiwiZXhwIjoxNTA2NDU1MTA4MDAwLCJpYXQiOjE1MDYzNjg3MDgsImp0aSI6IjU0ZWVmZDY0LTJlMzgtNDY1OS1iODY4LTAyNTk0YTc1MzhhMSIsImV4cF9pbiI6ODY0MDB9.l6dTmkpRjyBe6azSpwHM32q-ZUKr5_yrx53uxZ1PE0w'
```







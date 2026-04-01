<?php

use Src\Route;

Route::add('GET', '/', [Controller\Api::class, 'index']);
Route::add('POST', '/echo', [Controller\Api::class, 'echo']);

Route::add('POST', '/register', [Controller\ApiController::class, 'register']);
Route::add('POST', '/login', [Controller\ApiController::class, 'login']);

Route::add('GET', '/employees', [Controller\ApiController::class, 'employees'])
    ->middleware('auth_api');

Route::add('GET', '/employee/{id}', [Controller\ApiController::class, 'employee'])
    ->middleware('auth_api');
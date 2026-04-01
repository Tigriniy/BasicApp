<?php

use Src\Route;

Route::add('GET', '/', [Controller\Site::class, 'index'])
    ->middleware('guest');

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');

Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

Route::add(['GET', 'POST'], '/employees/add', [Controller\EmployeeController::class, 'createEmployee']);
Route::add('GET', '/employees', [Controller\EmployeeController::class, 'index']);

Route::add('GET', '/employees/delete', [Controller\EmployeeController::class, 'delete']);
Route::add(['GET', 'POST'], '/employees/edit', [Controller\EmployeeController::class, 'edit']);

Route::add('GET', '/employees/by_department', [Controller\EmployeeStats::class, 'byDepartment']);
Route::add('GET', '/departments/avg_age', [Controller\EmployeeStats::class, 'averageAge']);
Route::add('GET', '/employees/by_category', [Controller\EmployeeStats::class, 'byRole']);
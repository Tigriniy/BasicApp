<?php

use Src\Route;
use Controller\EmployeeStats;

Route::add('GET', '/', [Controller\Site::class, 'home'])
    ->middleware('guest');
Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/employees/add', [Controller\EmployeeController::class, 'createEmployee']);
Route::add('GET', '/employees', [Controller\Site::class, 'employees']);
Src\Route::add('GET', '/employees/delete', [Controller\Site::class, 'deleteEmployee']);
Src\Route::add(['GET', 'POST'], '/employees/edit', [Controller\Site::class, 'editEmployee']);

Route::add('GET', '/employees/by_department', [EmployeeStats::class, 'byDepartment']);
Route::add('GET', '/departments/avg_age', [Controller\EmployeeStats::class, 'averageAge']);
Route::add('GET', '/employees/by_category', [EmployeeStats::class, 'byRole']);



<?php

namespace Controller;

use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Model\Employee;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        if (!Auth::check()) {
            app()->route->redirect('/login');
        }

        $user = Auth::user();

        return new View('site.hello', ['message' => 'Добро пожаловать в систему отдела кадров!', 'user' => $user]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.signup');
        }

        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return new View('site.signup', ['error' => 'Только администратор может добавлять новых пользователей']);
        }

        $data = $request->all();
        unset($data['name']);
        $data['role'] = 'hr_employee';

        if (User::create($data)) {
            return new View('site.signup', ['success' => 'Новый сотрудник отдела кадров успешно добавлен']);
        }

        return new View('site.signup', ['error' => 'Ошибка при создании пользователя']);
    }

    public function login(Request $request)
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }
    public function employees(): string
    {
        $employees = \Model\Employee::all();

        return new \Src\View('site.employees', ['employees' => $employees]);
    }


    public function deleteEmployee(Request $request): void
    {

        $employee = Employee::find($request->get('id'));

        if ($employee) {
            $employee->delete();
        }


        app()->route->redirect('/employees');
    }


    public function editEmployee(Request $request): string
    {

        $employee = Employee::find($request->get('id'));

        if ($request->method === 'POST') {
            if ($employee && $employee->update($request->all())) {
                app()->route->redirect('/employees');
            }
        }

        return new \Src\View('site.edit_employee', ['employee' => $employee]);
    }


}
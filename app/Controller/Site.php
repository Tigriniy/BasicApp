<?php

namespace Controller;

use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

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
        if ($request->method === 'POST') {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                return new View('site.signup', ['error' => 'Только администратор может добавлять новых пользователей']);
            }

            $data = $request->all();
            unset($data['name']);
            $data['role'] = 'hr_employee';

            if (User::create($data)) {
                return new View('site.signup', ['success' => 'Новый сотрудник отдела кадров успешно добавлен']);
            }
        }

        return new View('site.signup');
    }
    public function login(Request $request): string
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

    public function createEmployee(Request $request): string
    {
        if (!Auth::check()) {
            app()->route->redirect('/login');
        }

        if ($request->method === 'POST') {
            $employee = new \Model\Employee();
            $employee->last_name = $request->last_name;
            $employee->first_name = $request->first_name;
            $employee->middle_name = $request->middle_name ?? null;
            $employee->gender = $request->gender;
            $employee->birth_date = $request->birth_date;
            $employee->registration_address = $request->registration_address ?? null;
            $employee->phone = $request->phone ?? null;
            $employee->email = $request->email ?? null;
            $employee->save();

            $order = new \Model\Order();
            $order->order_number = $request->order_number;
            $order->order_date = date("Y-m-d");
            $order->order_type = 'приём';
            $order->employee_id = $employee->employee_id;
            $order->department_id = $request->department_id;
            $order->position_id = $request->position_id;
            $order->save();

            return new View('employees.create', [
                'success' => 'Сотрудник успешно добавлен!',
                'departments' => \Model\Department::all(),
                'positions' => \Model\Position::all()
            ]);
        }

        return new View('employees.create', [
            'departments' => \Model\Department::all(),
            'positions' => \Model\Position::all()
        ]);
    }
}
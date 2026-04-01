<?php

namespace Controller;

use Model\Post;
use Src\View;
use Tigriniy\Framework\Http\Request;
use Model\User;
use Src\Auth\Auth;
use Model\Employee;
use Src\Validator\Validator;

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
            return '';
        }

        $user = Auth::user();
        return (new View())->render('site.hello', ['message' => 'Добро пожаловать в систему отдела кадров!', 'user' => $user]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'GET') {
            return (new View())->render('site.signup');
        }

        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return (new View())->render('site.signup', ['message' => 'Только администратор может добавлять пользователей']);
        }

        $validator = new Validator($request->all(), [
            'name' => ['required'],
            'login' => ['required', 'unique:users,login'],
            'password' => ['required']
        ], [
            'required' => 'Поле :field пусто',
            'unique' => 'Поле :field должно быть уникально'
        ]);

        if ($validator->fails()) {
            return (new View())->render('site.signup', [
                'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
            ]);
        }

        $data = $request->all();
        $data['role'] = 'hr_employee';
        $data['password'] = md5($data['password']);

        if (User::create($data)) {
            app()->route->redirect('/login');
            return '';
        }

        return (new View())->render('site.signup', ['message' => 'Ошибка при создании']);
    }

    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return (new View())->render('site.login');
        }

        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
            return '';
        }

        return (new View())->render('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function home(): void
    {
        if (Auth::check()) {
            app()->route->redirect('/hello');
        } else {
            app()->route->redirect('/login');
        }
    }
}
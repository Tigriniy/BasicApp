<?php

namespace Controller;

use Model\User;
use Model\Employee;
use Tigriniy\Framework\Http\Request;
use Src\View;

class ApiController
{
    public function register(Request $request): void
    {
        $data = $request->all();

        if (empty($data['login']) || empty($data['password'])) {
            $this->sendError('Не заполнены логин или пароль', 400);
            return;
        }

        $exists = User::where('login', $data['login'])->exists();
        if ($exists) {
            $this->sendError('Пользователь с таким логином уже существует', 400);
            return;
        }

        $token = md5(time() . $data['login'] . rand(1000, 9999));

        $user = User::create([
            'login' => $data['login'],
            'password' => md5($data['password']),
            'api_token' => $token,
            'role' => 'hr_employee'
        ]);

        if ($user) {
            $this->sendSuccess([
                'token' => $token,
                'user' => [
                    'id' => $user->users_id,
                    'login' => $user->login
                ]
            ], 'Регистрация успешна');
        } else {
            $this->sendError('Ошибка при регистрации', 500);
        }
    }

    public function login(Request $request): void
    {
        $data = $request->all();

        if (empty($data['login']) || empty($data['password'])) {
            $this->sendError('Не заполнены логин или пароль', 400);
            return;
        }

        $user = User::where('login', $data['login'])
            ->where('password', md5($data['password']))
            ->first();

        if (!$user) {
            $this->sendError('Неверный логин или пароль', 401);
            return;
        }

        $token = md5(time() . $user->login . rand(1000, 9999));
        $user->api_token = $token;
        $user->save();

        $this->sendSuccess([
            'token' => $token,
            'user' => [
                'id' => $user->users_id,
                'login' => $user->login
            ]
        ], 'Вход выполнен успешно');
    }

    public function employees(Request $request): void
    {
        $employees = Employee::all();

        $data = $employees->map(function($employee) {
            return [
                'id' => $employee->employee_id,
                'full_name' => $employee->last_name . ' ' . $employee->first_name . ' ' . ($employee->middle_name ?? ''),
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'middle_name' => $employee->middle_name,
                'gender' => $employee->gender,
                'birth_date' => $employee->birth_date,
                'phone' => $employee->phone,
                'email' => $employee->email,
                'photo' => $employee->image
            ];
        });

        $this->sendSuccess($data, 'Список сотрудников');
    }

    public function employee($id, Request $request): void
    {
        $employee = Employee::find($id);

        if (!$employee) {
            $this->sendError('Сотрудник не найден', 404);
            return;
        }

        $data = [
            'id' => $employee->employee_id,
            'full_name' => $employee->last_name . ' ' . $employee->first_name . ' ' . ($employee->middle_name ?? ''),
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'middle_name' => $employee->middle_name,
            'gender' => $employee->gender,
            'birth_date' => $employee->birth_date,
            'phone' => $employee->phone,
            'email' => $employee->email,
            'photo' => $employee->image
        ];

        $this->sendSuccess($data, 'Информация о сотруднике');
    }

    private function sendSuccess($data, $message = ''): void
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];

        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }

    private function sendError($message, $code = 400): void
    {
        $response = [
            'success' => false,
            'error' => $message
        ];

        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
<?php

namespace Controller;

use Src\Auth\Auth;
use Src\Request;
use Src\View;
use Model\Employee;
use Model\Order;
use Model\User;
class EmployeeController
{
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
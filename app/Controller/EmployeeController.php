<?php

namespace Controller;

use Src\Auth\Auth;
use Tigriniy\Framework\Http\Request;
use Src\View;
use Model\Employee;
use Model\Order;
use Model\Department;
use Model\Position;
use Src\Validator\Validator;

class EmployeeController
{
    public function createEmployee(Request $request): string
    {
        if (!Auth::check()) {
            app()->route->redirect('/login');
            return '';
        }

        $departments = Department::all();
        $positions = Position::all();

        if ($request->method === 'POST') {
            $messages = [
                'required' => 'Поле обязательно для заполнения',
                'name' => 'Поле должно содержать только буквы, дефис и пробел',
                'phone' => 'Введите корректный номер телефона',
                'email' => 'Введите корректный email',
            ];

            $validator = new Validator($request->all(), [
                'last_name' => ['required', 'name'],
                'first_name' => ['required', 'name'],
                'middle_name' => ['name'],
                'phone' => ['required', 'phone'],
                'email' => ['required', 'email'],
                'order_number' => ['required'],
                'department_id' => ['required'],
                'position_id' => ['required'],
            ], $messages);

            if ($validator->fails()) {
                $view = new View('employees.create', [
                    'errors' => $validator->errors(),
                    'departments' => $departments,
                    'positions' => $positions,
                    'old' => $request->all()
                ]);
                return (string) $view;
            }

            $data = $request->all();
            $data['image'] = null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['image'];
                $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $fileName = time() . '_' . uniqid() . '.' . $extension;
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                if (move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) {
                    $data['image'] = '/public/uploads/' . $fileName;
                }
            }

            $employee = Employee::create($data);

            Order::create([
                'order_number' => $request->order_number,
                'order_date' => date("Y-m-d"),
                'order_type' => 'приём',
                'employee_id' => $employee->employee_id,
                'department_id' => $request->department_id,
                'position_id' => $request->position_id,
            ]);

            app()->route->redirect('/employees');
            return '';
        }

        $view = new View('employees.create', [
            'departments' => $departments,
            'positions' => $positions
        ]);
        return (string) $view;
    }

    public function index(Request $request): string
    {
        $search = $request->get('search');

        if ($search) {
            $employees = Employee::where('last_name', 'like', "%$search%")
                ->orWhere('first_name', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->get();
        } else {
            $employees = Employee::all();
        }

        $view = new View('site.employees', ['employees' => $employees]);
        return (string) $view;
    }

    public function delete(Request $request): void
    {
        $employee = Employee::find($request->get('id'));
        if ($employee) {
            if ($employee->image && file_exists($_SERVER['DOCUMENT_ROOT'] . $employee->image)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $employee->image);
            }
            $employee->orders()->delete();
            $employee->delete();
        }
        app()->route->redirect('/employees');
    }

    public function edit(Request $request): string
    {
        $employee = Employee::find($request->get('id'));

        if ($request->method === 'POST') {
            $data = $request->all();
            unset($data['employee_id']);
            unset($data['image']);

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['image'];
                $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $fileName = time() . '_' . uniqid() . '.' . $extension;

                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/';
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    if ($employee->image && file_exists($_SERVER['DOCUMENT_ROOT'] . $employee->image)) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . $employee->image);
                    }
                    $data['image'] = '/public/uploads/' . $fileName;
                }
            }

            if ($employee && $employee->update($data)) {
                app()->route->redirect('/employees');
                return '';
            }
        }

        $view = new View('site.edit_employee', ['employee' => $employee]);
        return (string) $view;
    }
}
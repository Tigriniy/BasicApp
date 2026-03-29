<?php

namespace Controller;

use Src\Auth\Auth;
use Src\Request;
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
        }

        $departments = Department::all();
        $positions = Position::all();

        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'last_name' => ['required', 'name'],
                'first_name' => ['required', 'name'],
                'phone' => ['required', 'phone'],
                'email' => ['required', 'email'],
            ]);

            if ($validator->fails()) {
                return new View('employees.create', [
                    'errors' => $validator->errors(),
                    'departments' => $departments,
                    'positions' => $positions,
                    'old' => $request->all()
                ]);
            }

            $employee = Employee::create([
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'registration_address' => $request->registration_address,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            Order::create([
                'order_number' => $request->order_number,
                'order_date' => date("Y-m-d"),
                'order_type' => 'приём',
                'employee_id' => $employee->employee_id,
                'department_id' => $request->department_id,
                'position_id' => $request->position_id,
            ]);

            app()->route->redirect('/hello');
        }

        return new View('employees.create', [
            'departments' => $departments,
            'positions' => $positions
        ]);
    }

    public function index(Request $request): string
    {
        $search = $request->get('search');

        if ($search) {

            $employees = Employee::where('last_name', 'like', "%$search%")->get();
        } else {
            $employees = Employee::all();
        }

        return new View('site.employees', ['employees' => $employees]);
    }

    public function delete(Request $request): void
    {
        $employee = Employee::find($request->get('id'));
        if ($employee) {
            $employee->delete();
        }
        app()->route->redirect('/employees');
    }

    public function edit(Request $request): string
    {
        $employee = Employee::find($request->get('id'));

        if ($request->method === 'POST') {
            if ($employee && $employee->update($request->all())) {
                app()->route->redirect('/employees');
            }
        }

        return new View('site.edit_employee', ['employee' => $employee]);
    }
}
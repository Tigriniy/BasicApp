<?php

namespace Controller;

use Model\Employee;
use Model\Department;
use Model\StaffCategory;
use Model\Order;
use Src\View;
use Tigriniy\Framework\Http\Request;

class EmployeeStats
{
    public function byDepartment(Request $request): string
    {
        $depId = $request->get('department_id');

        $employees = $depId
            ? Employee::whereHas('orders', function ($query) use ($depId) {
                $query->where('department_id', $depId);
            })->get()
            : Employee::all();

        $departments = Department::all();

        return new View('site.by_department', [
            'employees' => $employees,
            'departments' => $departments,
            'current_dep' => $depId
        ]);
    }

    public function averageAge(): string
    {
        $stats = \Model\Order::selectRaw('
            orders.department_id, 
            AVG(TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE())) as avg_age
        ')
            ->join('employees', 'orders.employee_id', '=', 'employees.employee_id')
            ->groupBy('orders.department_id')
            ->with('department')
            ->get();

        $formattedStats = $stats->map(function($item) {
            return (object)[
                'department_name' => $item->department ? $item->department->name : "Деп. №" . $item->department_id,
                'avg_age' => $item->avg_age
            ];
        });

        return new View('site.average_age', ['stats' => $formattedStats]);
    }


    public function byRole(Request $request): string
    {
        $catId = $request->get('category_id');

        $employees = $catId
            ? Employee::whereHas('orders.position', function ($query) use ($catId) {
                $query->where('staff_category_id', $catId);
            })->get()
            : Employee::all();

        $categories = StaffCategory::all();

        return new View('site.by_role', [
            'employees' => $employees,
            'categories' => $categories,
            'current_cat' => $catId
        ]);
    }
}
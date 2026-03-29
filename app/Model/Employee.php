<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public function orders()
    {
        return $this->hasMany(Order::class, 'employee_id', 'employee_id');
    }

    protected $table = 'employees';

    protected $primaryKey = 'employee_id';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'last_name',
        'first_name',
        'middle_name',
        'gender',
        'birth_date',
        'registration_address',
        'phone',
        'email'
    ];
}
<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'orders_id';
    public $timestamps = false;

    protected $fillable = [
        'order_number',
        'order_date',
        'order_type',
        'employee_id',
        'department_id',
        'position_id',
        'order_file'
    ];
}
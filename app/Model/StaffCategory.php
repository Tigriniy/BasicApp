<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class StaffCategory extends Model
{
    protected $table = 'staff_categories';
    protected $primaryKey = 'staff_id';
    public $timestamps = false;

    protected $fillable = ['category_name'];

    public function positions()
    {
        return $this->hasMany(Position::class, 'staff_category_id', 'staff_id');
    }
}
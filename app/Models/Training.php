<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use SoftDeletes; 

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'department_id',
        'company_id',
    ];

    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_training')->withTimestamps();
    }
}

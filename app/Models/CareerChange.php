<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerChange extends Model
{
    protected $fillable = [
        'employee_id',
        'type',
        'title',
        'department_id',
        'salary',
        'change_date',
        'description',
    ];

    // Relationships
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

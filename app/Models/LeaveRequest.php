<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'days_requested',
        'reason',
        'manager_id',
        'hr_id', 
        'status',
        'manager_approval', 
        'hr_approval', 
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function hr()
    {
        return $this->belongsTo(Employee::class, 'hr_id');
    }
    
}

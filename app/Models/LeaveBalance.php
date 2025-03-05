<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    protected $fillable = [
        'employee_id',
        'annual_leave_days',
        'compensatory_days',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

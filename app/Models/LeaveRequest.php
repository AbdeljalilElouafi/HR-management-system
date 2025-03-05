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
        'status',
        'reason',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

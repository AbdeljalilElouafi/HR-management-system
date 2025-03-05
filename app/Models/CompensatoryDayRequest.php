<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompensatoryDayRequest extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'status',
        'reason',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

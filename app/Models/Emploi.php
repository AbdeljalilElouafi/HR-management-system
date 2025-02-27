<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Emploi extends Model
{
    use SoftDeletes; 

    protected $fillable = [
        'title',
        'description',
        'department_id',
    ];

    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}

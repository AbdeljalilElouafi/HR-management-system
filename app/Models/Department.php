<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'manager_id',
        'company_id',
    ];

   
    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}

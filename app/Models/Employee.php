<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    use HasFactory;


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'hire_date',
        'address',
        'contract_type',
        'salary',
        'status',
        'company_id',
        'department_id',
        'manager_id',
        'emploi_id',
        'user_id',
    ];

    protected $casts = [
        'hire_date' => 'date',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'manager_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function emploi()
    {
        return $this->belongsTo(Emploi::class);
    }

    public function careerChanges()
    {
        return $this->hasMany(CareerChange::class)->orderBy('change_date', 'desc');
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'employee_training')->withTimestamps();
    }

    public function leaveBalance()
    {
        return $this->hasOne(LeaveBalance::class);
    }

    public static function getHierarchy($companyId)
    {
        return self::where('company_id', $companyId)
            ->with('manager')
            ->get()
            ->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'name' => $employee->first_name . ' ' . $employee->last_name,
                    'title' => $employee->job ? $employee->job->title : 'Employee',
                    'parentId' => $employee->manager_id,
                ];
            });
    }

    public function calculateAnnualLeaveDays()
    {

        // dd($this->hire_date, gettype($this->hire_date));

        $hireDate = $this->hire_date;
        $now = now();
        $monthsWorked = $hireDate->diffInMonths($now);
        $yearsWorked = $hireDate->diffInYears($now);

        if ($yearsWorked < 1) {
            // Less than one year: 1.5 days per month
            return $monthsWorked * 1.5;
        } else {
            // After one year: 18 days + 0.5 days per year
            return 18 + ($yearsWorked - 1) * 0.5;
        }
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;


    protected $fillable = [
        'name',
        'sector',
        'address',
        'contact_email',
        'contact_phone',
        'registration_date',
    ];


}

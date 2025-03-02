<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.company-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_email' => 'required|string|email|max:255|unique:companies,contact_email',
            'contact_phone' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
       
        $company = Company::create([
            'name' => $request->company_name,
            'sector' => $request->sector,
            'address' => $request->address,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'registration_date' => now(),
        ]);
    
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' => $company->id, 
        ]);
    
        
        $user->assignRole('admin');
    
        
        auth()->login($user);
    
        return redirect('/dashboard')->with('success', 'Company and admin account created successfully.');
    }
}

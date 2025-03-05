<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function updateInfo(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $employee = Auth::user()->employee;
        $employee->update($request->only(['address', 'phone']));

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    public function show()
    {
        return view('profile.show');
    }
}

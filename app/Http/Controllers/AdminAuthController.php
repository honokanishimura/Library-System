<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    // Show the admin login form
    public function showLoginForm()
    {
        return view('admin.login'); 
    }

    // Handle admin login request
    public function login(Request $request)
    {
        // Validate credentials
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt login
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        // If login fails
        return back()->withErrors([
            'email' => 'Invalid login credentials.',
        ]);
    }

    // Admin dashboard view
    public function dashboard()
    {
        return view('admin.dashboard'); 
    }

    // Logout admin
    public function logout() 
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

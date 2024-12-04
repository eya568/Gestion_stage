<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
{
    return view('register'); // This shows the registration form
}

public function register(Request $request)
{
    // Validate form data
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    // Store user in the database
    User::create([
        'name' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Redirect after registration
    return redirect('/adminPanel')->with('success', 'User registered successfully');
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // Show login form
    public function login()
    {
        return view('alumnos.login');
    }

    // Authenticate user
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', "You're now logged in");
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}

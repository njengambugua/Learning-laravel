<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create() {
        return view('sessions.create');
    }

    public function store() {
        //vlidate th request
        $attributes = request()->validate([
            'email' => ['required', Rule::exists('users', 'email')],
            'password' => ['required']
        ]);

        if(! auth()->attempt($attributes)){
            throw ValidationException::withMessages(['email' => 'Your credentials are invalid']);
        }

        session()->regenerate();
        
        return redirect('/')->with('success', 'Welcome back');

        // return back()
        //     ->withInput()
        //     ->withErrors(['email' => 'Your credentials are invalid']);
    }

    public function destroy() {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}

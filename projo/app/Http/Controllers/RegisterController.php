<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }
    public function store()
    {
        //create the user
        $attributes =request()->validate([
            'name' => ['required','max:255'],
            'username' => ['required','max:255','min:3', Rule::unique('users', 'username')],
            'email' => ['required','email','max:255', Rule::unique('users', 'email')],
            'password' => ['required','min:7', 'max:255']
        ]);

        $user = User::create($attributes);

        auth()->login($user);

        // session()->flash('success', 'Your Account has been created.');

        return redirect('/')->with('success', 'Your Account has been created.');
    }
}

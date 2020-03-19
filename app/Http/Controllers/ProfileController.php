<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit()
    {
        return view('profile.edit');
    }

    public function update()
    {
        $validateData = $this->validateRequest();
        auth()->user()->update($validateData);
        return redirect('/home')->with('success', 'Profile updated successfuly.');
    }

    private function validateRequest()
    {
        $validatedData = request()->validate([
            'user_name' => 'required|string|max:255|unique:users,user_name,'.auth()->user()->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->user()->id,
        ]);
        if (!empty(request('password'))) {
            $validatedData += request()->validate([
                'password' => 'required|min:8|string',
            ]);
        }
        return $validatedData;
    }
}

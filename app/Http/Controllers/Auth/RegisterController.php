<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function __invoke()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        //validation
        $this->validate($request,
            ['name'=> 'required|max:255',
             'email'=> 'required|email|unique:users|max:255',
             'password'=> 'required|min:8|confirmed' 
            ]);     

        
        //store user
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email','password'));

        return redirect('/dashboard');
    }
    
}

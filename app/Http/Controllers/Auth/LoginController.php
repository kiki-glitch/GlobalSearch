<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function __invoke()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        //validation
        $this->validate($request,
            ['email'=> 'required|email',
              'password'=> 'required', 
            ]);  

        if (!auth()->attempt($request->only('email','password'),$request->remember)){
            return back()->with('status','Invalid login details');
        }

        return redirect('/dashboard');
    }
}

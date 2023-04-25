<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TablesController extends Controller
{
    public function index() {

        $users = User::latest()->get();
       


        // $users = User::latest()->get()->map(function ($user) {

        //     return [
        //         'id' => $user->id,
        //         'name' => $user->name,
        //         'email' => $user->email,
        //         // 'created_at' => $user->created_at->format('Y-m-d'),
        //         'created_at' => $user->created_at->format(config('app.date_format')),
        //     ];
        // });

        return $users;
        

         
    }

    public function store(Request $request)
    {
        return User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' =>Hash::make($request->password),

        ]);
    }

    public function update(User $user)
    {
        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password') ? Hash::make(request('password')) : $user->password,
        ]);

        return $user;
    }
}

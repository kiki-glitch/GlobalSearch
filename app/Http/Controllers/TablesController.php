<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TablesController extends Controller
{
    public function index() {

        $users =User::query()
        ->when(request('query'), function($query, $searchQuery){
            $query->where('name', 'like', "%{$searchQuery}%");
        })
        ->latest()
        ->paginate(5);
        // return response()->json($users);

        // $users = User::latest()->paginate(6);
        return $users;
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        return User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' =>Hash::make($request->password),

        ]);
    }

    public function update(User $user)
    {   
        request() -> validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' .$user->id,
            'password' => 'sometimes|min:8',
        ]);
        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password') ? Hash::make(request('password')) : $user->password,
        ]);

        return $user;
    }
    public function destroy(User $user){

        $user->delete();

        return response()->noContent();
    }

    // public function search(){

    //     $searchQuery = request('query');

    //     $users =User::where('name', 'like', "%{$searchQuery}%")->paginate(3);
    //     return response()->json($users);

    // }
}

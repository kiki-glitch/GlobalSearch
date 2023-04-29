<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationContoler extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
 
    }

    public function __invoke()
    {
        return view('layouts.app');
    }
}

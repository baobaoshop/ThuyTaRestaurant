<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Introduction;

class HomeController extends Controller
{
    public function index(){
        $introductions = Introduction::where('enable', true)->get();
        return view('home.index', compact('introductions'));
    }
}

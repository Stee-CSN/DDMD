<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        // This tells Laravel to look for a file named "home.blade.php"
        return view('home'); 
    }
}
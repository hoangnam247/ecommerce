<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct()
    {
        
    }
    public function index(){
      
        return view('home.home');
    }
}

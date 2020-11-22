<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use custom_helper;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index(){
        return view('admin.home');
    }
}

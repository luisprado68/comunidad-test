<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public $ggg = 'test';
    public function index(){
        return view('profile');
    }
}

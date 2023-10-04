<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyAgendaController extends Controller
{
    public function index(){
        return view('my_agendas');
    }
}

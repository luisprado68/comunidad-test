<?php

namespace App\Http\Controllers;

use App\Services\TwichService;
use App\Services\UserService;
use Illuminate\Http\Request;

class MyAgendaController extends Controller
{
    private $userService;
    public function __construct(TwichService $twichService, UserService $userService)
    {
        
        $this->userService = $userService;
    }
    
    public function index(){
        $active = false;
        if(session()->exists('user')){
            $user = session('user');
            
            $active = $this->userService->userExistsActive($user['display_name'].'@gmail.com',$user['id']);
          
            if($active){
               
                session(['status' =>$active]);
            }
            else{
                session(['status' => 0]);
            }
        }
        return view('my_agendas');
    }
}

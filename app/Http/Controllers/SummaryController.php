<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
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
        return view('summary');
    }
}

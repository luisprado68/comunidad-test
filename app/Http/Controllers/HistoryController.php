<?php

namespace App\Http\Controllers;

use App\Services\TwichService;
use App\Services\UserService;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    private $twichService;
    private $userService;
    public function __construct(TwichService $twichService, UserService $userService)
    {
        $this->twichService = $twichService;
        $this->userService = $userService;
    }
    public function index(){

        if(session()->exists('user')){
            $user = session('user');
            
            $userModel = $this->userService->userExistsActive($user['display_name'].'@gmail.com',$user['id']);
            // @dd($active);
            if($userModel->status){
               
                session(['status' => $userModel->status]);
            }
            else{
                session(['status' => 0]);
            }
        }
        return view('history',['user' => $userModel]);
    }
}

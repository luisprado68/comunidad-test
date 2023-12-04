<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Services\TwichService;
use App\Services\UserService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    private $userService;
    private $scheduleService;
    private $twichService;

    public $user;

    public function __construct(
        UserService $userService,
        ScheduleService $scheduleService,
        TwichService $twichService
        )
    {
        
        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
    }
    public function index(){
        $active = false;
        $arrayStream = [];
        if(session()->exists('user')){
            $this->user = session('user');
            
            $active = $this->userService->userExistsActive($this->user['display_name'].'@gmail.com',$this->user['id']);
          
            if($active){
               
                session(['status' =>$active]);
            }
            else{
                session(['status' => 0]);
            }
            $user_model = $this->userService->getByIdandTwichId($this->user['id']);
            $currentStreams = $this->scheduleService->getCurrentStream($user_model);
            foreach ($currentStreams as $key => $currentStream) {

                $video = $this->twichService->getStream($currentStream->user);
                array_push($arrayStream,$video);
            }
            dd($arrayStream);
            return view('support',['streams'=> $currentStreams]);
        }
        else{
            return redirect('/');
        }
        
    }
}

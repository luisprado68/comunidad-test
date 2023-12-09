<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Services\TwichService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    private $userService;
    private $scheduleService;
    private $twichService;

    public $user;
    public $show_streams = false;

    public function __construct(
        UserService $userService,
        ScheduleService $scheduleService,
        TwichService $twichService
        )
    {
        
        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
        $this->twichService = $twichService;
    }
    public function index(){
        $active = false;
        $date_string = ' --';
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
            // dump($user_model);
            $currentStreams = $this->scheduleService->getCurrentStream($user_model);
            $nextHour = $this->scheduleService->getNextStream($user_model);
            if(!empty($nextHour) && isset($nextHour)){
                $next =  new Carbon($nextHour->start);
            $day = $next->format('l');
            $date = $next->format('d-m ');
            $hour = $next->format('H:i');
            // dump($next->format('l'));
            // dump($currentStreams);
            $date_string = ' '.trans('user.create.'.strtolower($day)).' ' . $date .'a las '. $hour;
            }
            
            if(count($currentStreams) > 0){
                foreach ($currentStreams as $key => $currentStream) {

                    $video = $this->twichService->getStream($currentStream->user);
                    if(isset($video) && !empty($video)){
                        $size['name'] = $video['user_name'];
                        $size['login'] = $video['user_login'];
                        $size['img'] = str_replace("%{width}x%{height}", "500x300", $video['thumbnail_url']);
                        $size['url'] =  $video['url'];
                        array_push($arrayStream,$size);
                    }
                    
                }
            }
            if(count($arrayStream)> 0){
                $this->show_streams = true;
            }
            // dump($arrayStream);
            return view('support',['streams'=> $arrayStream,'show_streams'=> $this->show_streams,'date_string' => $date_string]);
        }
        else{
            return redirect('/');
        }
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Services\ScoreService;
use App\Services\TwichService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    private $twichService;
    private $userService;
    private $scheduleService;
    private $scoreService;
    public function __construct(TwichService $twichService, UserService $userService,ScheduleService $scheduleService,ScoreService $scoreService)
    {
        $this->twichService = $twichService;
        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
        $this->scoreService = $scoreService;
    }
    public function index(){
        $times = [];
        $user_array = [];
        $userModel = null;
        if(session()->exists('user')){
            $user = session('user');
            
            $userModel = $this->userService->userExistsActive($user['display_name'].'@gmail.com',$user['id']);
            $currentStreams = $this->scheduleService->getStreamByUser($userModel);
            
            if(count($currentStreams) > 0){
                $times = $this->scheduleService->getTimes($currentStreams,$userModel);
            }

            $scores = $this->scoreService->getByUsersId($userModel->id);
            foreach ($scores as $key => $score) {
                $user_found = $this->userService->getById($score->user_id);
                $updated = new Carbon($score->updated_at);
                $updated->locale('es');
                $updated->tz = $user_found->time_zone;
                
                // $updated->format('d-m-Y H:i')
                array_push($user_array,['channel' => $user_found->channel,'time' => $updated->format('i'),
                'date' =>  trans('user.create.' .strtolower($updated->format('l'))).' '.$updated->format('d').' '.trans('user.create.' .strtolower($updated->format('F'))).' '.$updated->format('H:i')]);
            }
            // dd($user_array);
            if($userModel->status){
               
                session(['status' => $userModel->status]);
            }
            else{
                session(['status' => 0]);
            }
            
        }
        return view('history',['user' => $userModel,'times' => json_encode($times),'scores' => $user_array]);
    }
}

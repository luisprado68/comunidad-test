<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Services\SupportScoreService;
use App\Services\TwichService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class MyAgendaController extends Controller
{
    private $userService;
    private $scheduleService;
    private $supportScoreService;

    public $showAgendas = false;
    public $schedules_by_user_new;
    public $week;
    public $day;
    public $user_model;
    public $agenda;
    public $user;

    public function __construct(
        TwichService $twichService,
        UserService $userService,
        ScheduleService $scheduleService,
        SupportScoreService $supportScoreService
    ) {

        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
        $this->supportScoreService = $supportScoreService;
    }

    public function index()
    {
        $active = false;
        $week = [];
        $new_schedulers = [];
        $groupedArray = [];
        // if (env('APP_ENV') == 'local') {
        //     $this->user_model = $this->userService->getById(env('USER_TEST'));
        // }
        if (session()->exists('user')) {
            $this->user = session('user');
            $this->user_model = $this->userService->userExistsActive($this->user['display_name'] . '@gmail.com', $this->user['id']);
          
            if ($this->user_model->status) {

                session(['status' => $this->user_model->status]);
            } else {
                session(['status' => 0]);
            }
          
            
            $groupedArray = $this->scheduleService->getSchedulerByUser($this->user_model);
            // $test = new Carbon('2024-02-11 00:10:00');
            // dump($test->format('H'));
            // dump($test->format('l'));
            $today = Carbon::now();
            $today->tz = $this->user_model->time_zone;

            foreach ($groupedArray as $key => $value) {
               
                if(strtolower($today->format('l')) == $key){

                    break;
                }
                unset($groupedArray[$key]);
            }
            return view('my_agendas', ['showAgendas' => $this->showAgendas, 'week' => $groupedArray, 'user' => $this->user_model]);
        }
        else{
            return redirect('/');
        }
       
    }

  
    public function getFormatDays($schedulers){
        $time_by_day = [];
        foreach ($schedulers as $key => $scheduler) {
               
            $date = new Carbon($scheduler->day);
           
            $dates =$this->scheduleService->getByUserIdAndDate($this->user_model,$scheduler->start);
            dump($dates);
            foreach ($dates as $key => $value) {
                
                $time = new Carbon($value->start);
                // dump($time);
                $time->tz = $this->user_model->time_zone;
                dump($time);
                array_push($time_by_day,$time->format('H:00'));
            }
            $day_name = strtolower($time->format('l'));
            $list_day[$day_name]['date'] = $time->format('d-m-Y');
            $list_day[$day_name]['times'] = $time_by_day;
            $time_by_day = [];
            
        }
        
        return $list_day;
    }
}

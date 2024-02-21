<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Services\SupportScoreService;
use App\Services\TwichService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
          
            $groupedArray['sunday']=[
            0 =>  [
              "day" => "monday",
              "time" => "15:00"
            ]];
            $groupedArray_two = $this->scheduleService->getSchedulerByUser($this->user_model);
            $groupedArray = array_merge($groupedArray, $groupedArray_two);
           
            // $test = new Carbon('2024-02-11 06:10:00');
            // dump($test->format('H'));
            // dump($test->format('l'));
            $today = Carbon::now();
            $today->tz = $this->user_model->time_zone;
            dump($today->format('l'));
            dump($groupedArray);

            $day_int = 0;
                    switch ($today->format('l')) {
                        case 'Sunday':
                            $day_int = 0;
                            break;
                        case 'Monday':
                            $day_int = 1;
                            break;
                        case 'Tuesday':
                            $day_int = 2;
                            break;
                        case 'Wednesday':
                            $day_int = 3;
                            break;
                        case 'Thursday':
                            $day_int = 4;
                            break;
                        case 'Friday':
                            $day_int = 5;
                            break;
                        case 'Saturday':
                            $day_int = 6;
                            break;
                    }
           
                    $i = 0;
            foreach ($groupedArray as $key => $value) {
                
                $groupedArray[$key]['status'] = false;
                if ($day_int <= $i) {
                    $groupedArray[$key]['status'] = true;
                }
                $i++;
               
            }
            // dd($groupedArray);
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

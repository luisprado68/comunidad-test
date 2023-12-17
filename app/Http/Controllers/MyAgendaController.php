<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Services\TwichService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MyAgendaController extends Controller
{
    private $userService;
    private $scheduleService;
    public $showAgendas = false;
    public $schedules_by_user_new;
    public $week;
    public $day;
    public $user_model;
    public $agenda;
    public $user;
    public function __construct(TwichService $twichService, UserService $userService, ScheduleService $scheduleService)
    {

        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
    }

    public function index()
    {
        $active = false;
        // if (env('APP_ENV') == 'local') {
        //     $this->user_model = $this->userService->getById(env('USER_TEST'));
        // }
        if (session()->exists('user')) {
            $this->user = session('user');
            $this->user_model = $this->userService->getByIdandTwichId($this->user['id']);
            $this->user_model = $this->userService->userExistsActive($this->user['display_name'] . '@gmail.com', $this->user['id']);

            if($this->user_model->status){
               
                session(['status' =>$this->user_model->status]);
        
            } else {
                session(['status' => 0]);
            }
        }
        if (!empty($this->user_model)) {
            $week = $this->getDays();
            
            if(count($week) > 0){
                $this->showAgendas = true;
            }
            
        }
       
        
        return view('my_agendas', ['showAgendas' => $this->showAgendas, 'week' => $week,'user' => $this->user_model]);
    }

    public function getDays()
    {
        $agenda = [];
        if(count( $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::MONDAY))) > 0){
            $agenda['monday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::MONDAY));
        }
        if(count( $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::TUESDAY))) > 0){
            $agenda['tuesday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::TUESDAY));
        }
        if(count( $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::WEDNESDAY))) > 0){
            $agenda['wednesday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::WEDNESDAY));
        }
        if(count( $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::THURSDAY))) > 0){
            $agenda['thursday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::THURSDAY));
        }
        if(count( $this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($this->user_model, Carbon::FRIDAY))) > 0){
            $agenda['friday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($this->user_model, Carbon::FRIDAY));
        }
        if(count( $this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($this->user_model, Carbon::SATURDAY))) > 0){
            $agenda['saturday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($this->user_model, Carbon::SATURDAY));
        }
        
        
        // dump($hour_diff);
        // dump($agenda);
        $current_time = Carbon::now();
        $current_time->tz = $this->user_model->time_zone;
        foreach ($agenda as $key => $day) {
            // dump($current_time);
            // dump($key);
            // dump(strtolower($current_time->format('l')));
            
            if(strtolower($current_time->format('l')) == $key){
                // unset($agenda[$key]);
                break;
            }else{
                unset($agenda[$key]);
            }
        }
       
        return $agenda;
    }
    public function getDateAndTime($days)
    {
        $list_day = [];
        if (count($days) > 0) {
            $date = new Carbon($days[0]->start);
            $list_day['date'] = $date->format('Y-m-d');
            $list_day['times'] = [];
            foreach ($days as $key => $value) {
                // dump($value->start);
                $day = new Carbon($value->start);
                $day->tz = $this->user_model->time_zone;
                array_push($list_day['times'], $day->format('H:i'));
            }
            return $list_day;
        }
        return $list_day;
        // dump($list_day);

    }
}

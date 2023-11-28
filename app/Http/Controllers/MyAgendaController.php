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
    public function __construct(TwichService $twichService, UserService $userService,ScheduleService $scheduleService)
    {
        
        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
    }
    
    public function index(){
        $active = false;
        if(env('APP_ENV') == 'local'){
            $this->user_model = $this->userService->getById(9);
           
        }
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
        if (!empty($this->user_model)) {
            $this->schedules_by_user_new = [];
            $this->week = [];
            $this->day['time'] = [];
            $schedules_by_user = $this->scheduleService->getScheduleorThisWeekByUserString($this->user_model);
            // dump($schedules_by_user);
            if(isset($schedules_by_user)){
                $order_schedules = $schedules_by_user;
            $schedules_by_user_day = $order_schedules->groupBy(function($date) {
                return Carbon::parse($date->start)->format('d'); // grouping by years
               
            });
            
            foreach ($schedules_by_user_day as $key => $item) {
                
                $date =  new Carbon($item[0]->start);
                foreach ($item as $key => $value) {
                    
                    $start =  new Carbon($value->start);
                    $start->tz = $this->user_model->time_zone;
                    
                    array_push($this->day['time'],$start->format('H:i'));
                   
                }
                $this->day['day'] = $date->dayName == 'Sunday' ? 'Saturday' : $date->dayName;
                array_push($this->week,$this->day);
                $this->day['time'] = [];
            }
            }
            
        }
        // dd($this->getDays());
        // foreach ($this->getDays() as $key => $value) {
        //     # code...
        // }
        $this->showAgendas = true;
        return view('my_agendas',['showAgendas'=> $this->showAgendas,'week'=> $this->getDays()]);
    }

    public function getDays(){

        $agenda = [];
        $agenda['monday']= $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model,Carbon::MONDAY));
        $agenda['tuesday']=  $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model,Carbon::TUESDAY));
        $agenda['wednesday']= $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model,Carbon::WEDNESDAY));
        $agenda['thursday']= $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model,Carbon::THURSDAY));
        $agenda['friday']= $this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($this->user_model,Carbon::FRIDAY));
        $agenda['saturday']= $this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($this->user_model,Carbon::SATURDAY));
        // dd($agenda);

        return $agenda;
    }
    public function getDateAndTime($days){

        $date = new Carbon($days[0]->start);
        $list_day['date'] = $date->format('Y-m-d');
        $list_day['times'] = [];
        foreach ($days as $key => $value) {
            // dump($value->start);
            $day = new Carbon($value->start);
            $day->tz = $this->user_model->time_zone;
        
            array_push($list_day['times'],$day->format('H:i'));
            
        }
        return $list_day;
        // dump($list_day);

    }
}

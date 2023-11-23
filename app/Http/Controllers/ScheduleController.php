<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Services\ScheduleService;
use App\Services\UserService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Return_;

class ScheduleController extends Controller
{
    private $userService;
    private $scheduleService;
    public $scheduler;
    public $times;
    public $days;
    public $days_with_time;
    public $schedule_avaible = false;
    public $user;
    public $hours_per_day_user = 0;
    public $countDay = 0;
    public $day_status = [];
    public $monday = [];
    public $tuesday = [];
    public $wednesday = [];
    public $thursday = [];
    public $friday = [];
    public $saturday = [];
    public $active = false;

    public function __construct(UserService $userService, ScheduleService $scheduleService)
    {

        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
    }
    public function index()
    {   
        
        if(env('APP_ENV') == 'local'){
            $user_model = $this->userService->getById(9);
           
        }
        //validar que el mismo usuario no carge otra vez en la mismo dia si tiene una hora diaria
        //si ya cumpkio con la hora del dia deshabilitar el dia
        if (session()->exists('user') || !empty($user_model )) {
            $this->user = session('user');

           
            if(env('APP_ENV') != 'local'){
                $this->active = $this->userService->userExistsActive($this->user['display_name'] . '@gmail.com', $this->user['id']);
                // $active = true;
                if ($this->active) {
    
                    session(['status' => $this->active]);
                } else {
                    session(['status' => 0]);
                }
                $user_model = $this->userService->getByIdandTwichId($this->user['id']);
            }else{
                $this->active = true;
            }
            
           
            if (!empty($user_model)) {
                $schedules_by_user = $this->scheduleService->getScheduleorThisWeekByUser($user_model->id);
                // dump($schedules_by_user);
                if (!isset($schedules_by_user)) {
                    $this->schedule_avaible = true;
                } elseif ($user_model->range->hours_for_week > count($schedules_by_user)) {
                    $this->schedule_avaible = true;
                }
            }
            if ($this->schedule_avaible) {

                $this->times = [
                    0 => ['hour' => '00:00', 'duplicated' => false, 'disabled' => false],
                    1 => ['hour' => '01:00', 'duplicated' => false, 'disabled' => false],
                    2 => ['hour' => '02:00', 'duplicated' => false, 'disabled' => false],
                    3 => ['hour' => '03:00', 'duplicated' => false, 'disabled' => false],
                    4 => ['hour' => '04:00', 'duplicated' => false, 'disabled' => false],
                    5 => ['hour' => '05:00', 'duplicated' => false, 'disabled' => false],
                    6 => ['hour' => '06:00', 'duplicated' => false, 'disabled' => false],
                    7 => ['hour' => '07:00', 'duplicated' => false, 'disabled' => false],
                    8 => ['hour' => '08:00', 'duplicated' => false, 'disabled' => false],
                    9 => ['hour' => '09:00', 'duplicated' => false, 'disabled' => false],
                    10 => ['hour' => '10:00', 'duplicated' => false, 'disabled' => false],
                    11 => ['hour' => '11:00', 'duplicated' => false, 'disabled' => false],
                    12 => ['hour' => '12:00', 'duplicated' => false, 'disabled' => false],
                    13 => ['hour' => '13:00', 'duplicated' => false, 'disabled' => false],
                    15 => ['hour' => '15:00', 'duplicated' => false, 'disabled' => false],
                    16 => ['hour' => '16:00', 'duplicated' => false, 'disabled' => false],
                    17 => ['hour' => '17:00', 'duplicated' => false, 'disabled' => false],
                    18 => ['hour' => '18:00', 'duplicated' => false, 'disabled' => false],
                    19 => ['hour' => '19:00', 'duplicated' => false, 'disabled' => false],
                    20 => ['hour' => '20:00', 'duplicated' => false, 'disabled' => false],
                    21 => ['hour' => '21:00', 'duplicated' => false, 'disabled' => false],
                    22 => ['hour' => '22:00', 'duplicated' => false, 'disabled' => false],
                    23 => ['hour' => '23:00', 'duplicated' => false, 'disabled' => false],
                ];
                $this->days_with_time = [
                    "lunes" => ['day' => 1, 'times' => $this->times,'status' => true],
                    "martes" => ['day' => 2, 'times' => $this->times,'status' => true],
                    "miercoles" => ['day' => 3, 'times' => $this->times,'status' => true],
                    "jueves" => ['day' => 4, 'times' => $this->times,'status' => true],
                    "viernes" => ['day' => 5, 'times' => $this->times,'status' => true],
                    "sabado" => ['day' => 6, 'times' => $this->times,'status' => true],

                ];
                // dump($this->days_with_time);
                // dump($user_model->range->hours_for_day);
                if($user_model->range->hours_for_day <= $this->scheduleService->getSchedulerDayByUser($user_model->id,Carbon::MONDAY)){
                    $this->days_with_time['lunes']['status']= false;
                    
                }
                if($user_model->range->hours_for_day <= $this->scheduleService->getSchedulerDayByUser($user_model->id,Carbon::TUESDAY)){
                    $this->days_with_time['martes']['status']= false;
                }
                if($user_model->range->hours_for_day <= $this->scheduleService->getSchedulerDayByUser($user_model->id,Carbon::WEDNESDAY)){
                    $this->days_with_time['miercoles']['status']= false;
                }
                if($user_model->range->hours_for_day <= $this->scheduleService->getSchedulerDayByUser($user_model->id,Carbon::THURSDAY)){
                    $this->days_with_time['jueves']['status']= false;
                }
                
                if($user_model->range->hours_for_day <= $this->scheduleService->getSchedulerDayEndByUser($user_model->id,Carbon::FRIDAY)){
                    $this->days_with_time['viernes']['status']= false;
                }
                if($user_model->range->hours_for_day <= $this->scheduleService->getSchedulerDayEndByUser($user_model->id,Carbon::SATURDAY)){
                    $this->days_with_time['sabado']['status']= false;
                }
                dump($this->days_with_time);

                $schedules = $this->scheduleService->getScheduleorThisWeek();
                if (isset($schedules)) {
                    Log::debug('schedules' . json_encode($schedules));
                    $www = CarbonImmutable::now()->locale('en_US');

                    foreach ($this->days_with_time as $key_day => $day_with_time) {
                        foreach ($day_with_time['times'] as $key_time => $time) {
                            //validar si supero el limite diario de hora y no permitir agregar en el mismo dia
                            // $this->countDay++;
                            // $this->hours_per_day_user = count($schedules->where('start', new Carbon($www->setDaysFromStartOfWeek($day_with_time['day'])->format('Y-m-d') . $time['hour']))->where('user_id', $user_model->id)) + $this->hours_per_day_user;
                            //validar la hora que ya seteo en deshabilitada
                            if (count($schedules->where('start', new Carbon($www->setDaysFromStartOfWeek($day_with_time['day'])->format('Y-m-d') . $time['hour']))->where('user_id', $user_model->id)) == 1) {
                                // dump($this->days_with_time[$key_day]['times'][$key_time]['disabled']);
                                $this->days_with_time[$key_day]['times'][$key_time]['disabled'] = true;
                            } elseif (count($schedules->where('start', new Carbon($www->setDaysFromStartOfWeek($day_with_time['day'])->format('Y-m-d') . $time['hour']))) == 1) {
                                // dump($this->days_with_time[$key_day]['times'][$key_time]['duplicated']);
                                $this->days_with_time[$key_day]['times'][$key_time]['duplicated'] = true;
                            } elseif (count($schedules->where('start', new Carbon($www->setDaysFromStartOfWeek($day_with_time['day'])->format('Y-m-d') . $time['hour']))) == 2) {
                                //remove item
                                $this->days_with_time[$key_day]['times'][$key_time]['disabled'] = true;
                            }
                        }
                    }
                    // dump($this->days_with_time);
                    $this->days = [
                        "lunes",
                        "martes",
                        "miercoles",
                        "jueves",
                        "viernes",
                        "sabado",

                    ];
                    // $teaTime = Carbon::createFromTimeString(Carbon::now(), 'America/Lima');
                    $en = CarbonImmutable::now()->locale('en_US');




                    // $nuevo = Carbon::now();
                    // $nuevo->day;
                    // $nuevo->hour = 3;
                    // $nuevo->minute = 50;
                    // $nuevo->tz = 'America/Argentina/Buenos_Aires';

                    // $ar = CarbonImmutable::now()->locale('ar');





                    // We still can force to use an other day as start/end of week
                    $start = $en->startOfWeek(Carbon::MONDAY);
                    $end = $en->endOfWeek(Carbon::SATURDAY);
                    // var_dump($start->format('Y-m-d'));                 // string(16) "2023-10-03 00:00"
                    // var_dump($end->format('Y-m-d'));

                    $time = "01:00";
                    $monday = new Carbon($start->format('Y-m-d') . $time);
                    // dump($monday);
                    // $monday->tz = 'America/Argentina/Buenos_Aires';

                    // echo "-----------\n";
                    // var_dump($en->week());                                 // int(6)
                    // var_dump($en->isoWeek());                              // int(5)
                    // var_dump($en->week(1)->format('Y-m-d H:i'));           // string(16) "2017-01-01 00:00"
                    // var_dump($en->isoWeek(1)->format('Y-m-d H:i'));        // string(16) "2017-01-08 00:00"

                    // // weekday/isoWeekday are meant to be used with days constants
                    // var_dump($en->weekday());                              // int(0)
                    // var_dump($en->isoWeekday());                           // int(7)
                    //  var_dump($en->weekday(CarbonInterface::MONDAY)
                    //     ->format('Y-m-d'));                                                                               // string(16) "2017-02-08 00:00"
                    // var_dump($en->isoWeekday(CarbonInterface::WEDNESDAY)
                    //     ->format('Y-m-d H:i'));                                                                                  // string(16) "2017-02-01 00:00"

                    // echo "-----------\n";
                    $date = CarbonImmutable::now()->locale('en_US');

                    // var_dump($date->getDaysFromStartOfWeek());                     // int(1)
                    // dump($date->setDaysFromStartOfWeek(1)->format('Y-m-d'));     
                    // dump($date->setDaysFromStartOfWeek(6));
                    // $date = CarbonImmutable::now()->locale('de_AT');

                    // var_dump($date->getDaysFromStartOfWeek());                     // int(0)
                    // var_dump($date->setDaysFromStartOfWeek(3)->format('Y-m-d'));   // string(10) "2022-12-08"

                    // // Or specify explicitly the first day of week
                    // var_dump($date->setDaysFromStartOfWeek(3, CarbonInterface::SUNDAY)->format('Y-m-d')); // string(10) "2022-12-07"


                    // $teaTime = Carbon::now();
                    // $teaTime->tz = 'America/Lima';
                    // $teaTime->hour = 0;
                    // // dump($teaTime);
                    // $dt = Carbon::now();
                    // // $dt->hour = 22;
                    // // $dt->minute = 32;
                    // $dt->tz = 'America/Argentina/Buenos_Aires';
                    // dump($dt->get('hour'));
                }
            }
            return view('schedule', ['times' => $this->times, 'days' => $this->days, 'days_with_time' => $this->days_with_time, 'schedule_avaible' => $this->schedule_avaible
            ,'day_status'=>$this->day_status]);
        } else {
            return redirect('/');
        }
    }

    public function test()
    {
        return view('test');
    }

    public function updateScheduler(Request $request)
    {
        Log::debug("updateScheduler");
        $this->user = session('user');

        if(env('APP_ENV') == 'local'){
            $user_model = $this->userService->getById(9);
            
        }else{
            $user_model = $this->userService->getByIdandTwichId($this->user['id']);
        }
        
        $schedules_by_user = $this->scheduleService->getScheduleorThisWeekByUser($user_model->id);
        if (!isset($schedules_by_user)) {
            $hours_for_week = 0;
        } else {
            $hours_for_week = count($schedules_by_user);
        }
        $scheduleNew = [];

        //validar si ya cargo las horas q tiene
        //validar por tango y cantidada de horas diarias y semanales y si pasa guardar
        // if($user_model->range->hours_for_day <= $this->scheduleService->getSchedulerDayByUser($user_model->id,Carbon::MONDAY)){
        //     $this->days_with_time['lunes']['status']= false;
            
        // }
      
        
        
        $data = $request->all();
        $data['status'] = 'ok';

        Log::debug("DAYS");
        Log::debug(json_encode($data['days']));


        foreach ($data['days'] as $key => $value) {

            Log::debug(json_encode(($value)));
            Log::debug(json_encode(count(($value['horarios']))));

            if($value['day'] == "1"){

                if (count(($value['horarios'])) +  $this->scheduleService->getSchedulerDayByUser($user_model->id,Carbon::MONDAY) > $user_model->range->hours_for_day) {
                    $data['status'] = 'error';
                    $data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }
            elseif($value['day'] == "2"){
                
                if (count(($value['horarios'])) +  $this->scheduleService->getSchedulerDayByUser($user_model->id,Carbon::TUESDAY) > $user_model->range->hours_for_day) {
                    $data['status'] = 'error';
                    $data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }
            elseif($value['day'] == "3"){
                
                if (count(($value['horarios'])) +  $this->scheduleService->getSchedulerDayByUser($user_model->id,Carbon::WEDNESDAY) > $user_model->range->hours_for_day) {
                    $data['status'] = 'error';
                    $data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }
            elseif($value['day'] == "4"){
                
                if (count(($value['horarios'])) +  $this->scheduleService->getSchedulerDayByUser($user_model->id,Carbon::THURSDAY) > $user_model->range->hours_for_day) {
                    $data['status'] = 'error';
                    $data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }
            elseif($value['day'] == "5"){
                
                if (count(($value['horarios'])) +  $this->scheduleService->getSchedulerDayByUser($user_model->id,Carbon::FRIDAY) > $user_model->range->hours_for_day) {
                    $data['status'] = 'error';
                    $data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }
            elseif($value['day'] == "6"){
                
                if (count(($value['horarios'])) +  $this->scheduleService->getSchedulerDayByUser($user_model->id,Carbon::SATURDAY) > $user_model->range->hours_for_day) {
                    $data['status'] = 'error';
                    $data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }
            
            $hours_for_week = count(($value['horarios'])) + $hours_for_week;
        }

        if ($data['status'] == 'ok' && $hours_for_week > $user_model->range->hours_for_week) {
            $data['status'] = 'error';
            $data['message'] = 'Supera las horas semanales permitidas';
        }
        if ($data['status'] == 'ok') {
            $date = CarbonImmutable::now()->locale('en_US');
            foreach ($data['days'] as $key => $value) {
                Log::debug(json_encode($value['day']));
                if (count(($value['horarios'])) > 0) {
                    foreach ($value['horarios'] as $key => $time) {

                        $scheduleNewItem['user_id'] = $user_model->id;
                        $scheduleNewItem['start'] =  new Carbon($date->setDaysFromStartOfWeek($value['day'])->format('Y-m-d') . $time);
                        array_push($scheduleNew, $scheduleNewItem);
                    }
                }
            }

            $this->scheduleService->bulkCreate($scheduleNew);
        }

        return $data;
    }
}

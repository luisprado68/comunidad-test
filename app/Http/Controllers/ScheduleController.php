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
    public function __construct(UserService $userService,ScheduleService $scheduleService)
    {

        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
    }
    public function index()
    {
        $this->times = [
            0 => ['hour'=> '00:00','duplicated' => false],
            1 => ['hour'=> '01:00','duplicated' => false],
            2 => ['hour'=> '02:00','duplicated' => false],
            3 => ['hour'=> '03:00','duplicated' => false],
            4 => ['hour'=> '04:00','duplicated' => false],
            5 => ['hour'=> '05:00','duplicated' => false],
            6 => ['hour'=> '06:00','duplicated' => false],
            7 => ['hour'=> '07:00','duplicated' => false],
            8 => ['hour'=> '08:00','duplicated' => false],
            9 => ['hour'=> '09:00','duplicated' => false],
            10 => ['hour'=> '10:00','duplicated' => false],
            11 => ['hour'=> '11:00','duplicated' => false],
            12 => ['hour'=> '12:00','duplicated' => false],
            13 => ['hour'=> '13:00','duplicated' => false],
            15 => ['hour'=> '15:00','duplicated' => false],
            16 => ['hour'=> '16:00','duplicated' => false],
            17 => ['hour'=> '17:00','duplicated' => false],
            18 => ['hour'=> '18:00','duplicated' => false],
            19 => ['hour'=> '19:00','duplicated' => false],
            20 => ['hour'=> '20:00','duplicated' => false],
            21 => ['hour'=> '21:00','duplicated' => false],
            22 => ['hour'=> '22:00','duplicated' => false],
            23 => ['hour'=> '23:00','duplicated' => false],
        ];
        $this->days_with_time = [
            "lunes" => ['day' => 1, 'times' => $this->times],
            "martes"=> ['day' =>2, 'times' =>$this->times],
            "miercoles"=> ['day' =>3,'times' => $this->times],
            "jueves"=> ['day' =>4,'times' => $this->times],
            "viernes"=> ['day' =>5,'times' => $this->times],
            "sabado"=> ['day' =>6, 'times' =>$this->times],

        ];
        $schedules = $this->scheduleService->getScheduleorThisWeek();
        Log::debug('schedules'.json_encode($schedules));
        dump($schedules);
        $www = CarbonImmutable::now()->locale('en_US');
        
        // $dayss = $schedules->where('start',new Carbon($www->setDaysFromStartOfWeek(2)->format('Y-m-d')."03:00"));
        // dump($dayss);
        foreach ($this->days_with_time as $key_day => $day_with_time) {
            foreach ($day_with_time['times'] as $key_time => $time) {
                // dump($time);
                if(count($schedules->where('start',new Carbon($www->setDaysFromStartOfWeek($day_with_time['day'])->format('Y-m-d').$time['hour']))) == 1){
                    dump($this->days_with_time[$key_day]['times'][$key_time]['duplicated']);
                    $this->days_with_time[$key_day]['times'][$key_time]['duplicated'] = true;
                    // dump($this->days_with_time[$key_day]);
                    // dump($key_day);
                    // dump($key_time);
                }
            }
            
        }
        // dump($this->days_with_time['lunes']['times']);
        dump($this->days_with_time['lunes']);
        // Log::debug('day'.json_encode( Carbon::parse($schedules[0]->start)->format('l')));
        // Log::debug('h'.json_encode( Carbon::parse($schedules[0]->start)->format('H')));
        // dump(Carbon::parse($schedules[0]->start)->format('l'));
        
        
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
        // dump($en);
        // $test = $en->startOfWeek(Carbon::MONDAY);
        // dump( $test);
        // dump( $en->startOfWeek(Carbon::HOURS_PER_DAY));


        
        // $nuevo = Carbon::now();
        // $nuevo->day;
        // $nuevo->hour = 3;
        // $nuevo->minute = 50;
        // $nuevo->tz = 'America/Argentina/Buenos_Aires';

        // $ar = CarbonImmutable::now()->locale('ar');

        // var_dump($en->firstWeekDay);                           // int(0)
        // var_dump($en->lastWeekDay);                            // int(6)
        // var_dump($en->startOfWeek()->format('Y-m-d H:i'));     // string(16) "2023-10-01 00:00"
        // var_dump($en->endOfWeek()->format('Y-m-d H:i'));

        

        // We still can force to use an other day as start/end of week
        $start = $en->startOfWeek(Carbon::MONDAY);
        $end = $en->endOfWeek(Carbon::SATURDAY);
        // var_dump($start->format('Y-m-d'));                 // string(16) "2023-10-03 00:00"
        // var_dump($end->format('Y-m-d'));

        $time = "01:00";
        $monday = new Carbon($start->format('Y-m-d').$time);
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
        $active = false;
        if (session()->exists('user')) {
            $user = session('user');

            $active = $this->userService->userExistsActive($user['display_name'] . '@gmail.com', $user['id']);

            if ($active) {

                session(['status' => $active]);
            } else {
                session(['status' => 0]);
            }
        }
        return view('schedule',['times'=> $this->times,'days' => $this->days,'days_with_time' => $this->days_with_time]);
    }

    public function test()
    {
        return view('test');
    }

    public function updateScheduler(Request $request){
      
        $scheduleNew = [];
        $hours_for_week = 0;
        $user = $this->userService->getById(9);
        //validar por tango y cantidada de horas diarias y semanales y si pasa guardar
      
        $data = $request->all();
        $data['status'] = 'ok';

        Log::debug("DAYS");
        Log::debug(json_encode($data['days']));

        
        foreach ($data['days'] as $key => $value) {
            Log::debug(json_encode(count(($value['horarios']))));
            if(count(($value['horarios'])) > $user->range->hours_for_day){
                $data['status'] = 'error';
                $data['message'] = 'Supera la hora diaria permitida';
                break;
            }
            
            $hours_for_week = count(($value['horarios'])) + $hours_for_week;
        }

        if( $data['status'] == 'ok' && $hours_for_week > $user->range->hours_for_week){
            $data['status'] = 'error';
            $data['message'] = 'Supera las horas semanales permitidas';
        }
        if( $data['status'] == 'ok'){
            $date = CarbonImmutable::now()->locale('en_US');
            foreach ($data['days'] as $key => $value) {
                Log::debug(json_encode($value['day']));
                if(count(($value['horarios'])) > 0){
                    foreach ($value['horarios'] as $key => $time) {

                        $scheduleNewItem['user_id'] = $user->id;
                        $scheduleNewItem['start'] =  new Carbon($date->setDaysFromStartOfWeek($value['day'])->format('Y-m-d').$time);
                        array_push($scheduleNew,$scheduleNewItem);
                    }
                }   
            }

            $this->scheduleService->bulkCreate($scheduleNew);
           
        }
        
        return $data;
    }
}

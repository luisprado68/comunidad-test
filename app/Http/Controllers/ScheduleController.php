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
    public function __construct(UserService $userService,ScheduleService $scheduleService)
    {

        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
    }
    public function index()
    {

        $schedules = $this->scheduleService->getScheduleorThisWeek();
        Log::debug('schedules'.json_encode($schedules));
        
        Log::debug('day'.json_encode( Carbon::parse($schedules[0]->start)->format('l')));
        Log::debug('h'.json_encode( Carbon::parse($schedules[0]->start)->format('H')));
        dump(Carbon::parse($schedules[0]->start)->format('l'));

        $this->times = [
            0 => '00:00',
            1 => '01:00',
            2 => '02:00',
            3 => '03:00',
            4 => '04:00',
            5 => '05:00',
            6 => '06:00',
            7 => '07:00',
            8 => '08:00',
            9 => '09:00',
            10 => '10:00',
            11 => '11:00',
            12 => '12:00',
            13 => '13:00',
            14 => '14:00',
            15 => '15:00',
            16 => '16:00',
            17 => '17:00',
            18 => '18:00',
            19 => '19:00',
            20 => '20:00',
            21 => '21:00',
            22 => '22:00',
            23 => '23:00',
        ];
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
        return view('schedule',['times'=> $this->times,'days' => $this->days]);
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

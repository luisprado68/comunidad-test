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
    public $data;

    public function __construct(UserService $userService, ScheduleService $scheduleService)
    {

        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
    }
    public function index()
    {
        $times = [];
        if (session()->exists('user')) {
            $this->user = session('user');
            $user_model = $this->userService->userExistsActive($this->user['display_name'] . '@gmail.com', $this->user['id']);

            if ($user_model->status) {

                session(['status' => $user_model->status]);
            } else {
                session(['status' => 0]);
            }
      
            if (!empty($user_model)) {
                $schedules_by_user = $this->scheduleService->getScheduleorThisWeekByUser($user_model);
                dump($schedules_by_user);
                $current_t = Carbon::now();
                $current_t->tz = $user_model->time_zone;
                $day = $current_t->format('l');

                    if ($day == 'Sunday' || $user_model->range_id == 1 ||  $user_model->role_id != 2) {


                        if ($day == 'Sunday') {
                           
                            $hour = intval($current_t->format('H'));
                            ////validar los horarios segun rango
                            
                            if (
                                $hour >= 14 && $user_model->range_id == 4 ||
                                $hour >= 16 && $user_model->range_id == 2 ||
                                $hour >= 15 && $user_model->range_id == 3
                            ) {
                                dump('paasaa');
                                if (!isset($schedules_by_user)) {
                                    $this->schedule_avaible = true;
                                } elseif ($user_model->range->hours_for_week > count($schedules_by_user)) {
                                    dump($schedules_by_user);
                                    dump($user_model->range->hours_for_week);
                                    $this->schedule_avaible = true;
                                }
                            }
                        } else {
                            dump('eslseeee');
                            if (!isset($schedules_by_user)) {
                                $this->schedule_avaible = true;
                            } elseif ($user_model->range->hours_for_week > count($schedules_by_user)) {
                                $this->schedule_avaible = true;
                            }
                        }
                    }
                
            }
            dump($this->schedule_avaible);
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
                    14 => ['hour' => '14:00', 'duplicated' => false, 'disabled' => false],
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
                    "lunes" => ['day' => 1, 'times' => $this->times, 'status' => true],
                    "martes" => ['day' => 2, 'times' => $this->times, 'status' => true],
                    "miercoles" => ['day' => 3, 'times' => $this->times, 'status' => true],
                    "jueves" => ['day' => 4, 'times' => $this->times, 'status' => true],
                    "viernes" => ['day' => 5, 'times' => $this->times, 'status' => true],
                    "sabado" => ['day' => 6, 'times' => $this->times, 'status' => true],

                ];

                if ($user_model->range->hours_for_day <= count($this->scheduleService->getSchedulerDayByUser($user_model, Carbon::MONDAY))) {
                    $this->days_with_time['lunes']['status'] = false;
                }
                if ($user_model->range->hours_for_day <= count($this->scheduleService->getSchedulerDayByUser($user_model, Carbon::TUESDAY))) {
                    $this->days_with_time['martes']['status'] = false;
                }
                if ($user_model->range->hours_for_day <= count($this->scheduleService->getSchedulerDayByUser($user_model, Carbon::WEDNESDAY))) {
                    $this->days_with_time['miercoles']['status'] = false;
                }
                if ($user_model->range->hours_for_day <= count($this->scheduleService->getSchedulerDayByUser($user_model, Carbon::THURSDAY))) {
                    $this->days_with_time['jueves']['status'] = false;
                }

                if ($user_model->range->hours_for_day <= count($this->scheduleService->getSchedulerDayEndByUser($user_model, Carbon::FRIDAY))) {
                    $this->days_with_time['viernes']['status'] = false;
                }
                if ($user_model->range->hours_for_day <= count($this->scheduleService->getSchedulerDayEndByUser($user_model, Carbon::SATURDAY))) {
                    $this->days_with_time['sabado']['status'] = false;
                }
                // dump($this->days_with_time);
                $schedules = $this->scheduleService->getScheduleorThisWeek($user_model);
                $new_schedules = [];
                dump($schedules);

                if (isset($schedules)) {
                    // Log::debug('schedules' . json_encode($schedules));
                    $www = $this->scheduleService->setSunday();

                    foreach ($this->days_with_time as $key_day => $day_with_time) {
                        foreach ($day_with_time['times'] as $key_time => $time) {

                            $new_start = $this->parseToCountry($www, $day_with_time['day'], $time['hour'], $user_model->time_zone);
                            // dump($new_start);
                            if (count($schedules->where('start', $new_start)->where('user_id', $user_model->id)) == 1) {
                                // dump($this->days_with_time[$key_day]['times'][$key_time]['disabled']);
                                $this->days_with_time[$key_day]['times'][$key_time]['disabled'] = true;
                            } elseif (count($schedules->where('start', $new_start)) == 1) {
                                // dump($this->days_with_time[$key_day]['times'][$key_time]['duplicated']);
                                $this->days_with_time[$key_day]['times'][$key_time]['duplicated'] = true;
                            } elseif (count($schedules->where('start', $new_start)) == 2) {
                                //remove item
                                $this->days_with_time[$key_day]['times'][$key_time]['disabled'] = true;
                            }
                        }
                    }
                    $this->days = [
                        "lunes",
                        "martes",
                        "miercoles",
                        "jueves",
                        "viernes",
                        "sabado",

                    ];
                    dump($day);
                    $day_int = 0;
                    switch ($day) {
                        case 'Sunday':
                            $day_int = 6;
                            break;
                        case 'Monday':
                            $day_int = 0;
                            break;
                        case 'Tuesday':
                            $day_int = 1;
                            break;
                        case 'Wednesday':
                            $day_int = 2;
                            break;
                        case 'Thursday':
                            $day_int = 3;
                            break;
                        case 'Friday':
                            $day_int = 4;
                            break;
                        case 'Saturday':
                            $day_int = 5;
                            break;
                    }
                    dump($day_int);
                    //saca los dias inclusive el actual para agendar los bronces
                    $i = 0;
                    foreach ($this->days_with_time as $key => $value) {
                        $this->days_with_time[$key]['status'] = false;
                        if ($day_int == $i) {
                            break;
                        }
                        $i++;
                    }
                }
            }
            return view('schedule', [
                'times' => $this->times, 'days' => $this->days, 'days_with_time' => $this->days_with_time, 'schedule_avaible' => $this->schedule_avaible, 'day_status' => $this->day_status, "user" => $user_model, 'times' => json_encode($times)
            ]);
        } else {
            return redirect('/');
        }
    }



    public function updateScheduler(Request $request)
    {
        Log::debug("updateScheduler");
        $this->user = session('user');

        // if(env('APP_ENV') == 'local'){
        //     $user_model = $this->userService->getById(env('USER_TEST'));

        // }else{
        $user_model = $this->userService->getByIdandTwichId($this->user['id']);
        // }

        $schedules_by_user = $this->scheduleService->getScheduleorThisWeekByUser($user_model);
        if (!isset($schedules_by_user)) {
            $hours_for_week = 0;
        } else {
            $hours_for_week = count($schedules_by_user);
        }
        $scheduleNew = [];


        $this->data = $request->all();
        $this->data['status'] = 'ok';

        Log::debug("DAYS");
        Log::debug(json_encode($this->data));


        foreach ($this->data['days'] as $key => $value) {

            Log::debug('value ' . json_encode(($value)));
            Log::debug('cantidad de horarios: ' . json_encode(count(($value['horarios']))));

            if ($value['day'] == "1") {

                if (count(($value['horarios'])) +  count($this->scheduleService->getSchedulerDayByUser($user_model, Carbon::MONDAY)) > $user_model->range->hours_for_day) {
                    $this->data['status'] = 'error';
                    $this->data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }
            if ($value['day'] == "2") {

                if (count(($value['horarios'])) +  count($this->scheduleService->getSchedulerDayByUser($user_model, Carbon::TUESDAY)) > $user_model->range->hours_for_day) {
                    $this->data['status'] = 'error';
                    $this->data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }
            if ($value['day'] == "3") {

                if (count(($value['horarios'])) +  count($this->scheduleService->getSchedulerDayByUser($user_model, Carbon::WEDNESDAY)) > $user_model->range->hours_for_day) {
                    $this->data['status'] = 'error';
                    $this->data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }
            if ($value['day'] == "4") {

                if (count(($value['horarios'])) +  count($this->scheduleService->getSchedulerDayByUser($user_model, Carbon::THURSDAY)) > $user_model->range->hours_for_day) {
                    $this->data['status'] = 'error';
                    $this->data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }
            if ($value['day'] == "5") {

                if (count(($value['horarios'])) +  count($this->scheduleService->getSchedulerDayEndByUser($user_model, Carbon::FRIDAY)) > $user_model->range->hours_for_day) {
                    $this->data['status'] = 'error';
                    $this->data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }
            if ($value['day'] == "6") {

                if (count(($value['horarios'])) +  count($this->scheduleService->getSchedulerDayEndByUser($user_model, Carbon::SATURDAY)) > $user_model->range->hours_for_day) {
                    $this->data['status'] = 'error';
                    $this->data['message'] = 'Supera la hora diaria permitida';
                    break;
                }
            }

            $hours_for_week = count(($value['horarios'])) + $hours_for_week;
        }

        if ($this->data['status'] == 'ok' && $hours_for_week > $user_model->range->hours_for_week) {
            $this->data['status'] = 'error';
            $this->data['message'] = 'Supera las horas semanales permitidas';
        } elseif ($this->data['status'] == 'ok') {

            $date  = $this->scheduleService->setSunday();
            // $date = CarbonImmutable::now()->locale('en_US');
            foreach ($this->data['days'] as $key => $value) {
                Log::debug(json_encode($value['day']));
                if (count(($value['horarios'])) > 0) {
                    foreach ($value['horarios'] as $key => $time) {

                        $scheduleNewItem['user_id'] = $user_model->id;
                        //$monday->tz = 'America/Argentina/Buenos_Aires';
                        // $start =  new Carbon($date->setDaysFromStartOfWeek($value['day'])->format('Y-m-d') . $time);
                        $new_start = $this->parseToCountry($date, $value['day'], $time, $user_model->time_zone);
                        $scheduleNewItem['start'] = $new_start;



                        array_push($scheduleNew, $scheduleNewItem);
                    }
                }
            }
            Log::debug('scheduleNew------------------');
            Log::debug(json_encode($scheduleNew));
            $ids = $this->scheduleService->bulkCreate($scheduleNew);
            Log::debug('ids');
            Log::debug(json_encode($ids));
        }
        Log::debug('data');
        Log::debug(json_encode($this->data));
        return $this->data;
    }

    public function parseToCountry($date, $day_param, $time, $time_zone)
    {
        $hour_diff = $this->scheduleService->parseHoursToCountry($date->endOfWeek($day_param), $time_zone);
        $utc =  new Carbon($date->setDaysFromStartOfWeek($day_param)->format('Y-m-d') . $time);
        $utc->addHours($hour_diff);

        return $utc;
    }
}

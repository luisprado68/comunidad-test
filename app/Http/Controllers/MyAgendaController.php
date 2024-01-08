<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Services\SupportScoreService;
use App\Services\TwichService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $times = [];
        // if (env('APP_ENV') == 'local') {
        //     $this->user_model = $this->userService->getById(env('USER_TEST'));
        // }
        if (session()->exists('user')) {
            $this->user = session('user');
            $this->user_model = $this->userService->userExistsActive($this->user['display_name'] . '@gmail.com', $this->user['id']);
            $currentStreams = $this->scheduleService->getStreamByUser($this->user_model);

            if (count($currentStreams) > 0) {
                $times = $this->scheduleService->getTimes($currentStreams, $this->user_model);
            }
            if ($this->user_model->status) {

                session(['status' => $this->user_model->status]);
            } else {
                session(['status' => 0]);
            }
            if (!empty($this->user_model)) {
                $week = $this->getDays();
    
                if (count($week) > 0) {
                    $this->showAgendas = true;
                }
            }
    
    
            return view('my_agendas', ['showAgendas' => $this->showAgendas, 'week' => $week, 'user' => $this->user_model, 'times' => json_encode($times)]);
        }
        else{
            return redirect('/');
        }
       
    }

    public function getDays()
    {
        $agenda = [];
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::MONDAY))) > 0) {
            $agenda['monday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::MONDAY));
        }
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::TUESDAY))) > 0) {
            $agenda['tuesday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::TUESDAY));
        }
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::WEDNESDAY))) > 0) {
            $agenda['wednesday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::WEDNESDAY));
        }
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::THURSDAY))) > 0) {
            $agenda['thursday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($this->user_model, Carbon::THURSDAY));
        }
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($this->user_model, Carbon::FRIDAY))) > 0) {
            $agenda['friday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($this->user_model, Carbon::FRIDAY));
        }
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($this->user_model, Carbon::SATURDAY))) > 0) {
            $agenda['saturday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($this->user_model, Carbon::SATURDAY));
        }

        if (count($agenda) > 0) {
            //actualiza el puntaje despues de agendar el usaurio
            $usersSupports = $this->supportScoreService->getByUserSupportId($this->user_model->id);
            if(count($usersSupports)> 0){
                foreach ($usersSupports as $key => $usersSupport) {
                    if ($usersSupport->point == 0) {
                        $usersSupport->point = 1;
                        $usersSupport->update();
                    }
                }
            }
          
            // dump($users);
        }

        // dump($agenda);

        $current_time = Carbon::now();
        $current_time->tz = $this->user_model->time_zone;
        foreach ($agenda as $key => $day) {
            // dump($current_time);
            // dump($key);
            // dump(strtolower($current_time->format('l')));
            //si es domingo mostratmos todos los dias
            if (strtolower($current_time->format('l')) == 'sunday') {
            } else {

                if (strtolower($current_time->format('l')) == $key) {
                    break;
                } elseif (
                    strtolower($current_time->format('l')) == 'monday' && $key == 'tuesday' ||
                    strtolower($current_time->format('l')) == 'monday' && $key == 'wednesday' ||
                    strtolower($current_time->format('l')) == 'monday' && $key == 'thursday' ||
                    strtolower($current_time->format('l')) == 'monday' && $key == 'friday' ||
                    strtolower($current_time->format('l')) == 'monday' && $key == 'saturday'
                ) {
                    // unset($agenda[$key]);
                    break;
                } elseif (
                    strtolower($current_time->format('l')) == 'tuesday' && $key == 'wednesday' ||
                    strtolower($current_time->format('l')) == 'tuesday' && $key == 'thursday' ||
                    strtolower($current_time->format('l')) == 'tuesday' && $key == 'friday' ||
                    strtolower($current_time->format('l')) == 'tuesday' && $key == 'saturday'
                ) {
                    // unset($agenda[$key]);
                    break;
                } elseif (
                    strtolower($current_time->format('l')) == 'wednesday' && $key == 'thursday' ||
                    strtolower($current_time->format('l')) == 'wednesday' && $key == 'friday' ||
                    strtolower($current_time->format('l')) == 'wednesday' && $key == 'saturday'
                ) {
                    // unset($agenda[$key]);
                    break;
                } elseif (
                    strtolower($current_time->format('l')) == 'thursday' && $key == 'friday' ||
                    strtolower($current_time->format('l')) == 'thursday' && $key == 'saturday'
                ) {
                    // unset($agenda[$key]);
                    break;
                } elseif (strtolower($current_time->format('l')) == 'friday' && $key == 'saturday') {
                    // unset($agenda[$key]);
                    break;
                } else {
                    unset($agenda[$key]);
                }
            }
        }
        // dump($agenda);
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

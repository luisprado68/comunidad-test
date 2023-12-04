<?php

namespace App\Services;

use App\Models\Schedule;
use App\Models\User;
use Broobe\Services\Service;
use Broobe\Services\Traits\{CreateModel, DestroyModel, ReadModel, UpdateModel};
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\Factory;
use Error;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

final class ScheduleService
{
    public $model;
    public $code_test;
    public $url_twitch;
    public $url;
    public $url_test;
    public $client_id;
    public $force_verify;
    public $complete_url;
    public $test_url;
    public $user;
    /**
     * Set model class name.
     *
     * @return void
     */
    protected function setModel(): void
    {
        $this->model = Schedule::class;
    }

    public function getById($id)
    {
        $this->setModel();
        $schedule = $this->model::where('id', $id)->first();
        if ($schedule) {
            return $schedule;
        } else {
            return null;
        }
    }

    public function getScheduleorThisWeek($user)
    {
        //para testeAR*****
        $this->setModel();
        // $en = CarbonImmutable::now()->locale('en_US');
        $en = $this->setSunday();
        $hour_first = $this->parseHoursToCountry($en->endOfWeek(Carbon::MONDAY),$user->time_zone);
        $start = $en->startOfWeek(Carbon::MONDAY)->addHours($hour_first)->format('Y-m-d H:00:00');
        // dump($start);
        $hour_end = $this->parseHoursToCountry($en->endOfWeek(Carbon::MONDAY),$user->time_zone);
        $end = $en->endOfWeek(Carbon::SATURDAY)->addHours($hour_end)->format('Y-m-d H:00:00');
        // dump($end);
        // $week = $this->model::whereBetween('start', [$start, $end])->get();
        $week = $this->model::all();
        if (count($week) > 0) {
            return $week;
        } else {
            return null;
        }
    }

    public function setSunday(){

        if(env('APP_ENV') == 'local' || env('APP_ENV') == 'prod' ){
            $toDisplay = CarbonImmutable::parse('2023-11-26 00:00:00', 'UTC');
            $martinDateFactory = new Factory([
                'locale' => 'en_US'
            ]);
            $toDisplay->addDays(1);
            $en = $martinDateFactory->make($toDisplay);
        }
        //else{
        //     $en = CarbonImmutable::now()->locale('en_US');
        //     $en->addDays(1);
        // }   
        
        return $en;
    }
    public function getScheduleorThisWeekByUser($user)
    {
        $this->setModel();
        // $en = CarbonImmutable::now()->locale('en_US');
        $en = $this->setSunday();
        $hour_first = $this->parseHoursToCountry($en->endOfWeek(Carbon::MONDAY),$user->time_zone);
        // dump($id);
        $start = $en->startOfWeek(Carbon::MONDAY)->addHours($hour_first)->format('Y-m-d H:00:00');
        // dump('------ week -----------------start');
        // dump($start);
        $hour_end = $this->parseHoursToCountry($en->startOfWeek(Carbon::MONDAY),$user->time_zone);
        $end = $en->endOfWeek(Carbon::SATURDAY)->addHours($hour_first)->format('Y-m-d H:00:00');

        // dump('------ week -----------------end');
        // dump($end);
        
        // $end = $en->startOfWeek(Carbon::SATURDAY);
       
        $week = $this->model::whereBetween('start', [$start, $end])->where('user_id',$user->id)->get();
        // dump($week);
        if (count($week) > 0) {
            return $week;
        } else {
            return null;
        }
    }
    public function getScheduleorThisWeekByUserString($user)
    {

        $this->setModel();
        $en = $this->setSunday();
        
        // $en = CarbonImmutable::now()->locale('en_US');
       
        // dump($id);
       
        // dump($start);
        
        $hour_first = $this->parseHoursToCountry($en->endOfWeek(Carbon::MONDAY),$user->time_zone);
        $start = $en->startOfWeek(Carbon::MONDAY)->addHours($hour_first)->format('Y-m-d H:00:00');
        // $end = $en->startOfWeek(Carbon::SATURDAY);
        // dump($start);
        $hour_end = $this->parseHoursToCountry($en->startOfWeek(Carbon::MONDAY),$user->time_zone);
        $end = $en->endOfWeek(Carbon::SATURDAY)->addHours($hour_end);
        $end->format('Y-m-d H:00:00');
        // dump($end);
        $week = $this->model::whereBetween('start', [$start, $end])->where('user_id',$user->id)->get();
        // dump($week);
        if (count($week) > 0) {
            return $week;
        } else {
            return null;
        }
    }

    public function getCurrentStream($user){

        $this->setModel();
        $date = Carbon::now();
        // $date->tz = $user->time_zone;
        $dates = $date->format('Y-m-d');
        $hour = $date->format('H');

        // $test = new Carbon($dates .$hour);
        // dump($dates);
        // dump($hour);
        $actual = new Carbon($dates.' ' .$hour.':00:00');
        // dump('actual');
        // dump($actual);
        $start = $actual->addMinutes(-15);
        // dump('start');
        $start_string = $start->format('Y-m-d H:i:s');
        $end = $actual->addMinutes(25);
        $end_string = $end->format('Y-m-d H:i:s');
        // dump('end');
        // dump($end);
        // dump($user);
        // $schedule = $this->model::whereBetween('start',[$start, $end])->where('user_id','!=',$user->id)->get();
        $currentStreams = $this->model::whereBetween('start',[$start_string, $end_string])->where('user_id','!=',$user->id)->distinct()->get();

        // dump($schedule);
        return $currentStreams;
    }
    public function parseHoursToCountry($end,$time_zone = null){
        // dump($time_zone);
        // dump($end);
        
        $start =  $end;
        // dump($start);
        $start->tz = $time_zone;
        // dump($start);
        $start_utc_country =  new Carbon($start->format('Y-m-d H:i'));
        // dump($start_utc_country);
        $utc =  $end;
       
        $diff = $start_utc_country->diffInHours($utc,false);   
        // dd($diff);
       
        
        return $diff;
    }
    public function getSchedulerDayByUser($user,$date)
    {   
        // dump('day');
       
        // dump($date);
        $this->setModel();
        $dates = null;
       
        $en = $this->setSunday();
        $hour_diff = $this->parseHoursToCountry($en->endOfWeek($date),$user->time_zone);
        if($date != 1){
            $start = $en->startOfWeek($date)->addHours($hour_diff)->format('Y-m-d H:00:00');
            $end = $en->startOfWeek($date)->addHour(23 + $hour_diff)->format('Y-m-d H:00:00');
        }
        else{
            $start = $en->startOfWeek($date)->addHours($hour_diff)->format('Y-m-d H:00:00');
            $end = $en->startOfWeek($date)->addHour(23 + $hour_diff)->format('Y-m-d H:00:00');
        }
        // dump('start');
        // dump($start);
        // dump('end');
        // dump($end);
  
        $dates = $this->model::whereBetween('start', [$start, $end])->where('user_id',$user->id)->orderBy('start', 'ASC')->get();
        // dump('hours');
        // dump($hours);
        return $dates;

    }
    public function getSchedulerDayEndByUser($user,$date)
    {
        $en = $this->setSunday();
        $hour_diff = $this->parseHoursToCountry($en->endOfWeek($date),$user->time_zone);
        // dump('day--------------------------------');
        // dump($date);
        $this->setModel();
        $dates = null;
        
        $start = $en->endOfWeek($date)->addHours(-23 + $hour_diff )->format('Y-m-d H:00:00');
        // dump('start--------------------------------');
        // dump($start);

        
        $end = $en->endOfWeek($date)->addHours($hour_diff);
        $end = $end->format('Y-m-d H:00:00');
        // dump('end--------------------------------');
        // dump($end);
        $dates = $this->model::whereBetween('start', [$start, $end])->where('user_id',$user->id)->get();
        // dump($hours);
        // dump('hours--------------');
        // dump($hours);
        return $dates;

    }

    // public function getByUserId($user_id)
    // {
    //     $this->setModel();
    //     $schedule = $this->model::where('user_id', $user_id)->first();
    //     if ($schedule) {
    //         return $schedule;
    //     } else {
    //         return null;
    //     }
    // }

    public function getUSchedules()
    {
        $this->setModel();

        $schedules = $this->model::all()->toArray();

        if (count($schedules) > 0) {
            return $schedules;
        } else {
            return false;
        }
    }

    /**
     * @param $userArray
     * @return false|mixed
     */
    public function create($userArray)
    {
        try {
            $schedule = new Schedule();
            $schedule->user_id = isset($userArray['user_id']) ? $userArray['user_id'] : $userArray['user_id'];
            $schedule->start = isset($userArray['start']) ? $userArray['start'] : $userArray['start'];
            // $schedule->end = isset($userArray['end']) ? $userArray['end'] : $userArray['end'];
            $schedule->save();
            return $schedule->id;
        } catch (Error $e) {
            return false;
        }
    }

    public function bulkCreate($userArray)
    {
        $schedulesIds = [];
        try {
            foreach ($userArray as $key => $value) {
                $schedule = new Schedule();
                $schedule->user_id = isset($value['user_id']) ? $value['user_id'] : $value['user_id'];
                $schedule->start = isset($value['start']) ? $value['start'] : $value['start'];
                // $schedule->end = isset($userArray['end']) ? $userArray['end'] : $userArray['end'];
                $schedule->save();
                array_push($schedulesIds, $schedule->id);
            }

            
            return $schedulesIds;
        } catch (Error $e) {
            return false;
        }
    }
    /**
     * @param array $user
     * @return User $user
     */
    public function update($userArray)
    {
        // dd($userArray['checkbox']);
        try {
            $schedule = Schedule::find($userArray['id']);
            $schedule->user_id = isset($userArray['user_id']) ? $userArray['user_id'] : $userArray['user_id'];
            $schedule->start = isset($userArray['start']) ? $userArray['start'] : $userArray['start'];
            // $schedule->end = isset($userArray['end']) ? $userArray['end'] : $userArray['end'];
            $schedule->update();
            return $schedule->id;
        } catch (Error $e) {
            return false;
        }
    }

    public function updateUser($userArray)
    {
        // dd($userArray['checkbox']);
        try {
            $user = User::find($userArray['id']);
            $user->name = $userArray['name'];
            $user->channel = $userArray['channel'];
            $user->country_id = intval($userArray['country']);
            $user->area = $userArray['area'];
            $user->phone = $userArray['phone'];
            $user->time_zone = $userArray['timezone'];
            $user->update();
            return $user->id;
        } catch (Error $e) {
            return false;
        }
    }
}

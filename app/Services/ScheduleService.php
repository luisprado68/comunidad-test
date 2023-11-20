<?php

namespace App\Services;

use App\Models\Schedule;
use App\Models\User;
use Broobe\Services\Service;
use Broobe\Services\Traits\{CreateModel, DestroyModel, ReadModel, UpdateModel};
use Carbon\Carbon;
use Carbon\CarbonImmutable;
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

    public function getScheduleorThisWeek()
    {
        $this->setModel();
        $en = CarbonImmutable::now()->locale('en_US');
        $start = $en->startOfWeek(Carbon::MONDAY);
        Log::debug('start' . json_encode($start));
        $end = $en->endOfWeek(Carbon::SATURDAY);
        Log::debug('end' . json_encode($end));
        $week = $this->model::whereBetween('start', [$start, $end])->get();

        if (count($week) > 0) {
            return $week;
        } else {
            return null;
        }
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

<?php

namespace App\Services;

use App\Models\Score;
use App\Models\User;
use Broobe\Services\Service;
use Broobe\Services\Traits\{CreateModel, DestroyModel, ReadModel, UpdateModel};
use Carbon\Carbon;
use Error;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

final class ScoreService
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
        $this->model = Score::class;
    }

    public function getById($id)
    {
        $this->setModel();
        $user = $this->model::where('id', $id)->first();
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }

    public function getByUserId($user_id)
    {
        $this->setModel();
        $user = $this->model::where('user_id', $user_id)->first();
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }


    public function getUsersModel()
    {
        $this->setModel();

        $users = $this->model::all();

        if (count($users) > 0) {
            return $users;
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
            $score = new Score();

            $score->user_id = isset($userArray['user_id']) ? $userArray['user_id'] : null;
            $score->points_day = isset($userArray['points_day']) ? $userArray['points_day'] : null;
            $score->points_week =  isset($userArray['points_week']) ? $userArray['points_week'] : null;
            $score->neo_coins = isset($userArray['neo_coins']) ? $userArray['neo_coins'] : null;
            $score->points_support = isset($userArray['points_support']) ? $userArray['points_support'] : null;
            $score->users_data = isset($userArray['users_data']) ? $userArray['users_data'] : null;
            $score->count_users = isset($userArray['count_users']) ? $userArray['count_users'] : null;
            $score->save();

            return $score;
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
            $score = Score::find($userArray['id']);
            $score->user_id = isset($userArray['user_id']) ? $userArray['user_id'] : null;
            $score->points_day = isset($userArray['points_day']) ? $userArray['points_day'] : null;
            $score->points_week = isset($userArray['points_week']) ? $userArray['points_week'] : null;
            $score->neo_coins = isset($userArray['neo_coins']) ? $userArray['neo_coins'] : null;
            $score->points_support = isset($userArray['points_support']) ? $userArray['points_support'] : null;
            $score->users_data = isset($userArray['users_data']) ? $userArray['users_data'] : null;
            $score->count_users = isset($userArray['count_users']) ? $userArray['count_users'] : null;
            $score->update();
            return $score->id;
        } catch (Error $e) {
            return false;
        }
    }

    public function evaluatePoint($user)
    {

        $current_time = Carbon::now();
        $current_time->tz = $user->time_zone;
        if (strtolower($current_time->format('l')) == 'sunday') {
            if ($user->score) {
                if ($user->score->points_week == 60) {
                    if ($user->range->id <= 4) {
                        $user->range_id = $user->range_id + 1;
                        $user->update();
                    }
                } elseif ($user->score->points_week == 60 && $user->range_id == 1) {

                    $user->range_id = 2;
                    $user->update();
                } elseif ($user->score->points_week >= 45 && $user->score->points_week < 60  && $user->range_id == 2) {
                    $user->range_id = 2;
                    $user->update();
                } elseif ($user->score->points_week >= 50 && $user->score->points_week < 60  && $user->range_id == 3) {
                    $user->range_id = 3;
                    $user->update();
                } elseif ($user->score->points_week >= 50 && $user->score->points_week < 60  && $user->range_id == 4) {
                    $user->range_id = 4;
                    $user->update();
                } elseif ($user->score->points_week <= 50 || $user->score->points_week < 45) {
                    $user->range_id = $user->range_id - $user->range_id;
                    $user->update();
                } elseif ($user->points_support == 25) {
                    $user->range_id = 4;
                    $user->update();
                }
            }
        }
    }
}

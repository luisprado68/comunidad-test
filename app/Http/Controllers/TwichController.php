<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Services\ScoreService;
use App\Services\TwichService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TwichController extends Controller
{
    private $userService;
    private $scheduleService;
    private $twichService;
    private $scoreService;
    public $showAgendas = false;
    public $schedules_by_user_new;
    public $week;
    public $day;
    public $user_model;
    public $agenda;
    public $user;
    public function __construct(TwichService $twichService, UserService $userService, ScheduleService $scheduleService, ScoreService $scoreService)
    {

        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
        $this->twichService = $twichService;
        $this->scoreService = $scoreService;
    }




    public function getChatters()
    {
        Log::debug("getChatters*****************************");
        $data = [];
        $user['user_id'] = 625226808;
        $user['user_login'] = 'shingineo';
        $user['user_name'] = 'shingineo';

        $user_two['user_id'] = 403034123;
        $user_two['user_login'] = 'XFilesDG';
        $user_two['user_name'] = 'XFilesDG';

        $user_three['user_id'] = 779124358;
        $user_three['user_login'] = 'lucho952000';
        $user_three['user_name'] = 'lucho952000';

        array_push($data, $user);
        array_push($data, $user_two);
        array_push($data, $user_three);

        $users = [];
        $users['status'] = 'error';
        if (session()->exists('user')) {
            $this->user = session('user');
            $this->user_model = $this->userService->getByIdandTwichId($this->user['id']);

            $users = $this->twichService->getUserChatters($this->user_model);
            // $users = $data;
            if (count($users) > 0) {

                foreach ($users as $key => $item) {
                    // dd($item);
                        $user_twich  = $this->userService->getByIdandTwichId($item['user_id']);
                        $score = $user_twich->score;
                        if (isset($score) && !empty($score)) {
                            if($score->count_users == count($users)){
                                if ($score->points_day == 10) {
                                    $score->points_day = 0;
                                } else {
                                    $score->points_day =  $score->points_day + 1;
                                }
                                
                                if ($score->points_week == 60) {
                                    $score->points_week = 0;
                                } else {
                                    $score->points_week = $score->points_week + 1;
                                }

                                $score->neo_coins = $score->neo_coins + 1;
                                $score->users_data = json_encode($users);
                                $score->count_users = count($users);
                                $score->update();
                               
                                session(['points_day' => $score->points_day ?? '0']);
                                session(['points_week' => $score->points_week ?? '0']);
                                session(['neo_coins' => $score->neo_coins ?? '0']);
                            }
                           
                            // dump($score);
                        } else {
                            $score['user_id'] = $user_twich->id;
                            $score['points_day'] = 1;
                            $score['points_week'] = 1;
                            $score['neo_coins'] = 1;
                            $score['users_data'] = json_encode($users);
                            $score['count_users'] = count($users);
                            
                            $created = $this->scoreService->create($score);
                            session(['points_day' => $created->points_day ?? '0']);
                            session(['points_week' => $created->points_week ?? '0']);
                            session(['neo_coins' => $created->neo_coins ?? '0']);
                            // dump($score);
                        }
                    
                }


                Log::debug("users*****************************");
                Log::debug(json_encode($users));
                $users['status'] = 'ok';
                return $users;
            }
        }
        return $users;
    }
}

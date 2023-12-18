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
        Log::debug("*****************getChatters*****************************");
        $data = [];
        // $user['user_id'] = 625226808;
        // $user['user_login'] = 'shingineo';
        // $user['user_name'] = 'shingineo';

        // $user_two['user_id'] = 403034123;
        // $user_two['user_login'] = 'XFilesDG';
        // $user_two['user_name'] = 'XFilesDG';

        // $user_three['user_id'] = 779124358;
        // $user_three['user_login'] = 'lucho952000';
        // $user_three['user_name'] = 'lucho952000';

        // array_push($data, $user);
        // array_push($data, $user_two);
        // array_push($data, $user_three);

        $users = [];
        $users['status'] = 'error';
        $users['message'] = 'error';
        if (session()->exists('user')) {
            $this->user = session('user');
            $this->user_model = $this->userService->getByIdandTwichId($this->user['id']);

            $users = $this->twichService->getUserChatters($this->user_model);
            Log::debug('users controller------------------');
            Log::debug(json_encode($users));
          
                if (count($users) > 0) {
                    Log::debug('getUserChatters---------------------');
                    Log::debug($users);
                    Log::debug('count users---------------------');
                    Log::debug(count($users));
                    
                    foreach ($users as $key => $item) {
                        Log::debug('item---------------------');
                        Log::debug($item);
                            $user_twich  = $this->userService->getByIdandTwichId($item['user_id']);
                            Log::debug('user_twich---------------------');
                            Log::debug($user_twich);

                            if(!empty($user_twich) && $user_twich->id != $this->user_model->id){
                                $score = $user_twich->score;
                                if (isset($score) && !empty($score)) {
                                    Log::debug('score count_users---------------------');
                                    Log::debug($score->count_users);
                                    $current = Carbon::now();
                                    // Log::debug('--------------current---------------------');
                                    // Log::debug($current->format('H'));
                                    $last = new Carbon( $score->updated_at);
                                    // Log::debug('--------------last---------------------');
                                    // Log::debug($last->format('H'));
                                    //$score->count_users == count($users)
                                    if($current->format('H') != $last->format('H') ){
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
                                       
                                    }
                                   
                                    // dump($score);
                                } else {
                                    Log::debug('else---------------------');
                                    Log::debug($user_twich);

                                    $score['user_id'] = $user_twich->id;
                                    $score['points_day'] = 1;
                                    $score['points_week'] = 1;
                                    $score['neo_coins'] = 1;
                                    $score['users_data'] = json_encode($users);
                                    $score['count_users'] = count($users);
                                    
                                    $created = $this->scoreService->create($score);
                                    
                                    // dump($score);
                                }
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

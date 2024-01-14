<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Services\ScoreService;
use App\Services\StreamSupportService;
use App\Services\TwichService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TwichController extends Controller
{
    private $userService;
    private $scheduleService;
    private $streamSupportService;

    private $twichService;
    private $scoreService;
    public $showAgendas = false;
    public $schedules_by_user_new;
    public $week;
    public $day;
    public $user_model;
    public $agenda;
    public $user;
   

    public function __construct(TwichService $twichService, UserService $userService,
    ScheduleService $scheduleService, ScoreService $scoreService,StreamSupportService $streamSupportService )
    {

        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
        $this->twichService = $twichService;
        $this->scoreService = $scoreService;
        $this->streamSupportService = $streamSupportService;
    }




    public function getChatters()
    {
        Log::debug("*****************getChatters*****************************");
        $data = [];
       
        $users = [];
        $users['status'] = 'error';
        $users['message'] = 'error';
        $supportStreams = [];
        if (session()->exists('user')) {
            $this->user = session('user');
            $this->user_model = $this->userService->getByIdandTwichId($this->user['id']);

            $users = $this->twichService->getUserChatters($this->user_model); 
                if (count($users) > 0) {
                    
                    foreach ($users as $key => $item) {
                            $user_twich  = $this->userService->getByIdandTwichId($item['user_id']);
                          
                            if(!empty($user_twich) && $user_twich->id != $this->user_model->id){
                                $current_t = Carbon::now();
                                $minute_t = $current_t->format('i');
                                if($minute_t >=  env('CHATTERS_MIN_MINUTE') && $minute_t <= env('CHATTERS_MIN_MINUTE_2') ||
                                 $minute_t >=  env('CHATTERS_MAX_MINUTE') && $minute_t <= env('CHATTERS_MAX_MINUTE_2')){
                                    Log::debug('*********** PASA EL TIEMPO*************');
                                    $supportStreams = $user_twich->streamSupport;
                                    Log::debug('*********** supportStreams*************');
                                    Log::debug(json_encode($supportStreams));
                                    if(count($supportStreams)>0){
                                        foreach ($supportStreams as $key => $supportStream) {
                                            // if($supportStream->supported)
                                            $support_created = json_decode($supportStream->supported);
                                            Log::debug('*********** support_created*************');
                                            Log::debug(json_encode($support_created));
                                            if($support_created->id == $this->user_model->id){

                                                Log::debug('*********** pasassss*************');
                                                Log::debug(json_encode($support_created));
                                                $supportStream->supported = json_encode($support_created);
                                                $supportStream->update();
                                            }
                                        }
                                    }
                                    else{
                                        $support['id'] = $this->user_model->id;
                                        $support['name'] = $this->user_model->channel;
                                        $streamSupport['user_id'] = $user_twich->id;
                                        $streamSupport['supported'] = json_encode($support);
                                        $created = $this->streamSupportService->create($streamSupport);
                                    }
                                }
                                
                                $current = Carbon::now();
                                $minute = $current->format('i');

                                if($minute == env('CHATTERS_MAX_MINUTE') || $minute == env('CHATTERS_MAX_MINUTE_2') ){
                                    $score = $user_twich->score;
                                        Log::debug('score---------------------');
                                        Log::debug($score);
                                    if (isset($score) && !empty($score)) {
                                    
                                        $last = new Carbon( $score->updated_at);
                                        $user_support['id'] = $this->user_model->id;
                                        $user_support['name'] = $this->user_model->channel;
                                            //minuto minute == 10
                                                if($current->format('H') == $last->format('H')
                                                || $current->format('H') != $last->format('H') 
                                                ){
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
                                                    // $score->users_data = json_encode($users);
                                                    // $score->count_users = count($users);
                                                    $score->streamer_supported = json_encode($user_support);
                                                    $score->update();

                                                }

                                    } else {
                                        Log::debug('else---------------------');
                                        Log::debug($user_twich);

                                        $score['user_id'] = $user_twich->id;
                                        $score['points_day'] = 1;
                                        $score['points_week'] = 1;
                                        $score['neo_coins'] = 1;
                                        // $score['users_data'] = json_encode($users);
                                        // $score['count_users'] = count($users);
                                        
                                        $created = $this->scoreService->create($score);
                                        
                                        // dump($score);
                                    }
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


    public function getChattersKernel()
    {
        Log::debug("*****************getChatters*****************************");
        $data = [];
       
        $users = [];
        $users['status'] = 'error';
        $users['message'] = 'error';
        $supportStreams = [];
        if (session()->exists('user')) {
            $this->user = session('user');
            $this->user_model = $this->userService->getByIdandTwichId($this->user['id']);

            $users = $this->twichService->getUserChatters($this->user_model); 
                if (count($users) > 0) {
                    
                    foreach ($users as $key => $item) {
                            $user_twich  = $this->userService->getByIdandTwichId($item['user_id']);
                          
                            if(!empty($user_twich) && $user_twich->id != $this->user_model->id){
                                $current_t = Carbon::now();
                                $minute_t = $current_t->format('i');
                                if($minute_t >=  env('CHATTERS_MIN_MINUTE') && $minute_t <= env('CHATTERS_MIN_MINUTE_2') ||
                                 $minute_t >=  env('CHATTERS_MAX_MINUTE') && $minute_t <= env('CHATTERS_MAX_MINUTE_2')){
                                    Log::debug('*********** PASA EL TIEMPO*************');
                                    $supportStreams = $user_twich->streamSupport;
                                    Log::debug('*********** supportStreams*************');
                                    Log::debug(json_encode($supportStreams));
                                    if(count($supportStreams)>0){
                                        foreach ($supportStreams as $key => $supportStream) {
                                            // if($supportStream->supported)
                                            $support_created = json_decode($supportStream->supported);
                                            Log::debug('*********** support_created*************');
                                            Log::debug(json_encode($support_created));
                                            if($support_created->id == $this->user_model->id){

                                                Log::debug('*********** pasassss*************');
                                                Log::debug(json_encode($support_created));
                                                $supportStream->supported = json_encode($support_created);
                                                $supportStream->update();
                                            }
                                        }
                                    }
                                    else{
                                        $support['id'] = $this->user_model->id;
                                        $support['name'] = $this->user_model->channel;
                                        $streamSupport['user_id'] = $user_twich->id;
                                        $streamSupport['supported'] = json_encode($support);
                                        $created = $this->streamSupportService->create($streamSupport);
                                    }
                                }
                                
                                $current = Carbon::now();
                                $minute = $current->format('i');

                                if($minute == env('CHATTERS_MAX_MINUTE') || $minute == env('CHATTERS_MAX_MINUTE_2') ){
                                    $score = $user_twich->score;
                                        Log::debug('score---------------------');
                                        Log::debug($score);
                                    if (isset($score) && !empty($score)) {
                                    
                                        $last = new Carbon( $score->updated_at);
                                        $user_support['id'] = $this->user_model->id;
                                        $user_support['name'] = $this->user_model->channel;
                                            //minuto minute == 10
                                                if($current->format('H') == $last->format('H')
                                                || $current->format('H') != $last->format('H') 
                                                ){
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
                                                    // $score->users_data = json_encode($users);
                                                    // $score->count_users = count($users);
                                                    $score->streamer_supported = json_encode($user_support);
                                                    $score->update();

                                                }

                                    } else {
                                        Log::debug('else---------------------');
                                        Log::debug($user_twich);

                                        $score['user_id'] = $user_twich->id;
                                        $score['points_day'] = 1;
                                        $score['points_week'] = 1;
                                        $score['neo_coins'] = 1;
                                        // $score['users_data'] = json_encode($users);
                                        // $score['count_users'] = count($users);
                                        
                                        $created = $this->scoreService->create($score);
                                        
                                        // dump($score);
                                    }
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

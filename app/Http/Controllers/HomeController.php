<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Services\ScoreService;
use App\Services\TwichService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Stevebauman\Location\Commands\Update;

class HomeController extends Controller
{
    public $profile_image_url;
    public $response;
    private $twichService;
    private $userService;
    private $scheduleService;
    private $scoreService;
    public function __construct(TwichService $twichService, UserService $userService,ScheduleService $scheduleService,
    ScoreService $scoreService)
    {
        $this->twichService = $twichService;
        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
        $this->scoreService = $scoreService;
    }
    public function index()
    {

        $active = false;
        $times = [];

        // $users = $this->userService->getUsersModel();
        //         // Log::debug('-------------------------------------------------users: '. json_encode($users));
        //         if(count($users) > 0){
        //             foreach ($users as $key => $user) {
        //                 $this->scoreService->evaluatePoint($user);
        //                 //reseteo de puntos TODO bulk update
        //                 $user_array['user_id'] = $user->id;
        //                 $user_array['points_day'] = 0;
        //                 $user_array['points_week'] = 0;
        //                 $result = $this->scoreService->update($user_array);
                        
        //             }

        //             //LOg:

        //         }
        // if(session()->exists('support_to_user')){
        //     dump(session('support_to_user'));
        // }
        // $users_score = $this->scoreService->getUsersSixty();
        // foreach ($users_score as $key => $user_score) {
        //     dump($user_score->points_week);
        //     if($user_score->points_week == 60){
        //         if($user_score->range_id != 4){
        //             $range_id_new = $user_score->range_id + 1;
        //             $user_score->range_id = $range_id_new;
        //             $user_score->update();
        //         }
                
        //     }
        // }

        // dump($users_score);
        if(session()->exists('user')){
            $user = session('user');
            Log::debug('user------------------------ ' . json_encode($user));
            $userModel = $this->userService->userExistsActive($user['display_name'].'@gmail.com',$user['id']);
            
            if($userModel){
                if($userModel->status){
               
                    session(['status' => $userModel->status]);
                }
                else{
                    session(['status' => 0]);
                }
            }
            

            
        }
        $users = $this->userService->getUsersTop();
        $users = $users->toArray();
        
        $twoElements1 = array_slice($users, 0, 3);
        
        // Get two elements starting from index 3
        $twoElements2 = array_slice($users, 3,3);
         // Get two elements starting from index 3
         $twoElements3 = array_slice($users, 6, 3);
          // Get two elements starting from index 3
        $twoElements4 = array_slice($users, 9,1);
        $top = 1;
        $top_two = 4;
        $top_three = 7;
        $top_four = 10;

        return view('home',['users' => $users,'twoElements1' => $twoElements1,'twoElements2' => $twoElements2,
        'twoElements3' => $twoElements3,'twoElements4' => $twoElements4,'top' => $top,'top_two' => $top_two,'top_three' => $top_three,'top_four' => $top_four]);
        
    }

  
}

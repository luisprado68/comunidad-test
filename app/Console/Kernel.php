<?php

namespace App\Console;

use App\Services\ScheduleService;
use App\Services\ScoreService;
use App\Services\TwichService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class Kernel extends ConsoleKernel
{
    private $twichService;
    private $scheduleService;
    private $userService;
    private $scoreService;
    private $schedulerService;
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
          
            $this->twichService = new TwichService();
            $this->scheduleService = new ScheduleService();

            $now =  Carbon::now();
            $minute = $now->format('i');
            
            if ($minute == 5  || $minute == 59) {
                
                Log::debug('-------------------------------------------------minute: ' . $minute);
                Log::debug('---------------[START]  Chatters ------------');
               
                $currentStreams = $this->scheduleService->getCurrentStreamKernel();
                Log::debug('**** currentStreams ******** ');
                Log::debug(json_encode($currentStreams));
                if (count($currentStreams) > 0) {
                    foreach ($currentStreams as $key => $schedule_streaming) {

                        $chatters_schedule =  $this->twichService->getChattersKernel($schedule_streaming);
                       
                    }
                }

                Log::debug('---------------[FINISH] END Chatters------------');
            } else {
                Log::debug('---------------No esta habilitado------------');
            }
        })->everyMinute();

        $schedule->call(function () {
            Log::debug('---------------[START] Update Refresh Tokens --------');
            $this->userService = new UserService();
            $this->twichService = new TwichService();
            $this->scoreService = new ScoreService();
            $this->schedulerService = new ScheduleService();
            $allUsers = $this->userService->all();
            $now =  Carbon::now();
         
            $day = $now->format('l');
            $hour = $now->format('H');
           
            
            if($day == 'Sunday' && $hour == "00"){
                Log::debug('---------------[Start] Start Reset Points---------------');
                Log::debug('hour' . json_encode($hour));
                Log::debug('day' . json_encode($day));
                foreach ($allUsers as $key => $user) {
                    // $this->twichService->getRefreshToken($user);
                    $user_array['user_id'] = $user->id;
                    $user_array['points_day'] = 0;
                    $user_array['points_week'] = 0;
                    $result = $this->scoreService->update($user_array);

                    $schedulers_by_user = $this->schedulerService->getByUserId($user_array);

                    if(count($schedulers_by_user) > 0){
                        foreach ($schedulers_by_user as $key => $scheduler_by_user) {
                            $date = new Carbon($scheduler_by_user->start);
                            $day = $date->format('l');
                            if($day != 'Sunday'){
                                $this->schedulerService->delete($scheduler_by_user->id);
                            }
                        }
                    }


                    Log::debug('result:  ---' . json_encode($result));
                }
                Log::debug('---------------[Start] Start Reset Points---------------');
            }
            Log::debug('---------------[FINISH] END Update Refresh Tokens---------------');
        })->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Console;

use App\Services\ScheduleService;
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
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            Log::debug('---------------[START]  Chatters ------------');
            $this->twichService = new TwichService();
            $this->scheduleService = new ScheduleService();

            $now =  Carbon::now();
            $minute = $now->format('i');
            Log::debug('----------------------------------------------minute: ' . $minute);
            if ($minute >= env('CHATTERS_MIN_MINUTE_2') && $minute <= env('CHATTERS_MIN_MINUTE_2') || 
                $minute >= env('CHATTERS_MAX_MINUTE') && $minute <= env('CHATTERS_MAX_MINUTE_2')) {
                
                $currentStreams = $this->scheduleService->getCurrentStreamKernel();
                Log::debug('**** currentStreams ******** ');
                Log::debug(json_encode($currentStreams));
                if (count($currentStreams) > 0) {
                    foreach ($currentStreams as $key => $schedule_streaming) {

                        $chatters_schedule =  $this->twichService->getChattersKernel($schedule_streaming);
                        //    Log::debug('**** chatters_schedule ******** ');
                        //    Log::debug(json_encode($chatters_schedule));
                    }
                }

                Log::debug('---------------[FINISH] END Chatters------------');
            } else {
                Log::debug('---------------No esta habilitado------------');
            }
        })->everyTenMinutes();

        $schedule->call(function () {
            Log::debug('---------------[START] Update Refresh Tokens --------');
            $this->userService = new UserService();
            $this->twichService = new TwichService();
            $allUsers = $this->userService->all();
          
            foreach ($allUsers as $key => $user) {
                $this->twichService->getRefreshToken($user);
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

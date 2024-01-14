<?php

namespace App\Console;

use App\Services\ScheduleService;
use App\Services\TwichService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
class Kernel extends ConsoleKernel
{
    private $twichService;
    private $scheduleService;
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            Log::debug('---------------[START] Synchronize Orders Woo-----------------');
            $this->twichService = new TwichService();
            $this->scheduleService = new ScheduleService();

            $currentStreams = $this->scheduleService->getCurrentStreamKernel();
            Log::debug('**** currentStreams ******** ');
            Log::debug(json_encode($currentStreams));
            if(count($currentStreams)> 0){
                foreach ($currentStreams as $key => $schedule_streaming) {

                   $chatters_schedule =  $this->twichService->getChattersKernel($schedule_streaming);
                   Log::debug('**** chatters_schedule ******** ');
                   Log::debug(json_encode($chatters_schedule));
                }
            }
            
            // $this->twichService->getRefreshToken($user);

            Log::debug('---------------[FINISH] END Synchronize Orders Woo------------');
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

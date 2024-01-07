<?php

namespace App\Http\Controllers;

use App\Services\BillingService;
use App\Services\ScheduleService;
use App\Services\TwichService;
use App\Services\UserService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public $code;
    public $code_test;
    public $url_twitch;
    public $url;
    public $url_test;
    public $client_id;
    public $force_verify;
    public $complete_url;
    public $test_url;
    public $user;
    private $twichService;
    private $userService;
    private $scheduleService;

    public function __construct(TwichService $twichService, UserService $userService, ScheduleService $scheduleService,)
    {
        $this->twichService = $twichService;
        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
    }

    public function index()
    {
        Log::debug('index-----');
        
        return view('admin.adminLogin');
    }
    public function login(Request $request)
    {
        Log::debug('login-----');
        $credentials = $request->all();
        // dd($credentials);
        $user = $this->twichService->getUser();
        $exist = $this->userService->userLogin($credentials['email'], $credentials['password']);

       
        if (!empty($exist)){
            // dd($exist);
            Log::debug('exist-----');
            return redirect('admin/list');
        } else {
            return redirect('admin');
        }

        // return view('admin.adminLogin');
    }
    public function list()
    {
        if (Session::has('user-log')) {
            $users = $this->userService->getUsersModel();
            // dd($users);
            return view('admin.list', ['users' => $users]);
        } else {
            return redirect('admin');
        }
    }
    public function edit($id)
    {
        if (Session::has('user-log')) {
            $user = $this->userService->getById($id);
            return view('admin.edit', ['user' => $user]);
        } else {
            return redirect('admin');
        }
    }
    public function show($id){
        $date_array = [];
        if (Session::has('user-log')) {
            $user = $this->userService->getById($id);

            $schedules = $user->schedules;
            // foreach ($schedules as $key => $value) {
            //     $actual_before = new Carbon($value->start);
            //     $actual_before->tz = $user->time_zone;

            //     $date = ['day' => trans('user.create.' .strtolower($actual_before->format('l'))), 'month' => trans('user.create.' .strtolower($actual_before->format('F'))), 'time' => $actual_before->format('H:i')];
            //     array_push($date_array,$date);
            // }
            $date_array = $this->getDays($user);
            return view('admin.show', ['user' => $user,'date_array' => $date_array]);
        } else {
            return redirect('admin');
        }
    }
    public function getDays($user)
    {

        $agenda = [];
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($user, Carbon::MONDAY))) > 0) {
            $agenda['monday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($user, Carbon::MONDAY));
        }
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($user, Carbon::TUESDAY))) > 0) {
            $agenda['tuesday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($user, Carbon::TUESDAY));
        }
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($user, Carbon::WEDNESDAY))) > 0) {
            $agenda['wednesday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($user, Carbon::WEDNESDAY));
        }
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($user, Carbon::THURSDAY))) > 0) {
            $agenda['thursday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayByUser($user, Carbon::THURSDAY));
        }
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($user, Carbon::FRIDAY))) > 0) {
            $agenda['friday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($user, Carbon::FRIDAY));
        }
        if (count($this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($user, Carbon::SATURDAY))) > 0) {
            $agenda['saturday'] = $this->getDateAndTime($this->scheduleService->getSchedulerDayEndByUser($user, Carbon::SATURDAY));
        }

        if (count($agenda) > 0) {
            //actualiza el puntaje despues de agendar el usaurio
            // $usersSupports = $this->supportScoreService->getByUserSupportId($user->id);
            // if(count($usersSupports)> 0){
            //     foreach ($usersSupports as $key => $usersSupport) {
            //         if ($usersSupport->point == 0) {
            //             $usersSupport->point = 1;
            //             $usersSupport->update();
            //         }
            //     }
            // }
          
            // dump($users);
        }

        // dump($agenda);

        $current_time = Carbon::now();
        $current_time->tz = $user->time_zone;
        foreach ($agenda as $key => $day) {
            // dump($current_time);
            // dump($key);
            // dump(strtolower($current_time->format('l')));
            //si es domingo mostratmos todos los dias
            if (strtolower($current_time->format('l')) == 'sunday') {
            } else {

                if (strtolower($current_time->format('l')) == $key) {
                    break;
                } elseif (
                    strtolower($current_time->format('l')) == 'monday' && $key == 'tuesday' ||
                    strtolower($current_time->format('l')) == 'monday' && $key == 'wednesday' ||
                    strtolower($current_time->format('l')) == 'monday' && $key == 'thursday' ||
                    strtolower($current_time->format('l')) == 'monday' && $key == 'friday' ||
                    strtolower($current_time->format('l')) == 'monday' && $key == 'saturday'
                ) {
                    // unset($agenda[$key]);
                    break;
                } elseif (
                    strtolower($current_time->format('l')) == 'tuesday' && $key == 'wednesday' ||
                    strtolower($current_time->format('l')) == 'tuesday' && $key == 'thursday' ||
                    strtolower($current_time->format('l')) == 'tuesday' && $key == 'friday' ||
                    strtolower($current_time->format('l')) == 'tuesday' && $key == 'saturday'
                ) {
                    // unset($agenda[$key]);
                    break;
                } elseif (
                    strtolower($current_time->format('l')) == 'wednesday' && $key == 'thursday' ||
                    strtolower($current_time->format('l')) == 'wednesday' && $key == 'friday' ||
                    strtolower($current_time->format('l')) == 'wednesday' && $key == 'saturday'
                ) {
                    // unset($agenda[$key]);
                    break;
                } elseif (
                    strtolower($current_time->format('l')) == 'thursday' && $key == 'friday' ||
                    strtolower($current_time->format('l')) == 'thursday' && $key == 'saturday'
                ) {
                    // unset($agenda[$key]);
                    break;
                } elseif (strtolower($current_time->format('l')) == 'friday' && $key == 'saturday') {
                    // unset($agenda[$key]);
                    break;
                } else {
                    unset($agenda[$key]);
                }
            }
        }
        // dump($agenda);
        return $agenda;
    }

    
    public function delete($id)
    {
        if (Session::has('user-log')) {
            $user = $this->userService->getById($id);
            $user->delete();
            $users = $this->userService->getUsersModel();
            // return view('admin.list', ['users' => $users]);
            return redirect('admin/list');
        }
        //  else {
        //     return redirect('admin');
        // }
    }
    public function post(Request $request)
    {
        $user = $request->all();
       
        $user = $this->userService->update($user);

        $users = $this->userService->getUsersModel();
        // dd($users);
        return view('admin.list', ['users' => $users]);
    }
    public function logoutAdmin(){
        session()->forget('user-log');
        return redirect('/');
    }
    public function getToken(Request $request)
    {
        $this->twichService->getToken($request);
        $user = $this->twichService->getUser();
        $exist = $this->userService->userExists($user['display_name'] . '@gmail.com', $user['id']);
        if ($exist == false) {
            $this->userService->create($user);
        }

        return redirect('/');
    }
    public function logout()
    {
        // session()->forget('user');
        session()->forget('user-log');
        // session()->forget('points_day');
        // session()->forget('points_week');
        // session()->forget('status');
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\BillingService;
use App\Services\RangeService;
use App\Services\RoleService;
use App\Services\ScheduleService;
use App\Services\StreamSupportService;
use App\Services\SupportScoreService;
use App\Services\TwichService;
use App\Services\UserService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Database\Eloquent\Collection;
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
    public $user_model;
    private $twichService;
    private $userService;
    private $scheduleService;
    private $streamSupportService;
    private $rangeService;

    public function __construct(
        TwichService $twichService,
        UserService $userService,
        ScheduleService $scheduleService,
        StreamSupportService $streamSupportService,
        RangeService $rangeService
    ) {
        $this->twichService = $twichService;
        $this->userService = $userService;
        $this->scheduleService = $scheduleService;
        $this->streamSupportService = $streamSupportService;
        $this->rangeService = $rangeService;
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


        if (!empty($exist)) {
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
            $this->user_model = session('user-log');
            $users = $this->userService->getUsersModel();
            // dd($users);
            return view('admin.list', ['users' => $users, 'user_model' => $this->user_model]);
        } else {
            return redirect('admin');
        }
    }
    public function schedulers()
    {
        $week_time_zone = [];
        $new_streams = [];
        $users = [];
        $all = [];
        if (Session::has('user-log')) {
            $this->user_model = session('user-log');
            $users = $this->userService->getUsersModel();
            $week = $this->scheduleService->getSchedulerWeek($this->user_model);

            $supports_ids = $this->streamSupportService->getSupportsStreams();
            if(isset($supports_ids)){
                foreach ($supports_ids as $key => $support) {
                    // $test = $support->unique('supported');
                    // dd($support);
                    $user_obteined = $this->userService->getById($support->user_id);
                    if (isset($user_obteined)) {
                        $supports = $this->streamSupportService->getStreamSupportsByUserId($user_obteined->id);
                        $user['name'] =  $user_obteined->channel;
                        $collection = new Collection();
                        foreach ($supports as $key => $support_found) {
    
                            $sup = json_decode($support_found->supported);
    
                            $collection->push((object)[
                                'id' => $sup->id,
                                'name' => $sup->name
                            ]);
                            // array_push($new_streams,$sup->name);
                        }
                        $unique = $collection->unique('id');
                        $new_streams = $unique->toArray();
                        // dump($new_streams);
                        $user['supported'] = $new_streams;
                        array_push($all, $user);
                    }
                }
            }
            // dump($supports_ids);
            // dump('ssss');
            // dump($all);
            // foreach ($week as $key => $value) {

            //     $date = new Carbon($value->start);
            //     $date->tz = $this->user_model->time_zone;

            //     array_push($week_time_zone,['date' => $date->format('d-m-Y H:i:s'),'user' => $value->user->name]);

            // }
            // dd($week);
            return view('admin.schedulers', ['users' => $users, 'user_model' => $this->user_model, 'week' => $week, 'all' => $all]);
        } else {
            return redirect('admin');
        }
    }
    public function edit($id)
    {
        if (Session::has('user-log')) {
            $ranges = $this->rangeService->all();
            $user = $this->userService->getById($id);
            return view('admin.edit', ['user' => $user, 'ranges' => $ranges]);
        } else {
            return redirect('admin');
        }
    }
    public function show($id)
    {
        $date_array = [];
        $streamers_supported = [];
        $test = null;
        if (Session::has('user-log')) {
            $user = $this->userService->getById($id);

            if (isset($user->score)) {
                $date = new Carbon($user->score->updated_at);
                $date->tz = $user->time_zone;
                $test = $date->format('d-m-Y H:i:s');
            }

            if (isset($user->streamSupport)) {
                // dd($user->streamSupport);
                foreach ($user->streamSupport as $streamer) {
                    $supported = json_decode($streamer->supported);
                    // dd($supported->name);
                    array_push($streamers_supported, ['name' => $supported->name, 'time' => $streamer->updated_at]);
                }
            }



            $date_array = $this->getDays($user);
            return view('admin.show', ['user' => $user, 'date_array' => $date_array, 'date' => $test, 'streamers_supported' => $streamers_supported]);
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


        // $current_time = Carbon::now();
        // $current_time->tz = $user->time_zone;

        // dump($agenda);
        return $agenda;
    }

    public function getDateAndTime($days)
    {
        $this->user_model = session('user-log');
        $list_day = [];
        if(isset($days)){
            if (count($days) > 0) {
                $date = new Carbon($days[0]->start);
                $list_day['date'] = $date->format('Y-m-d');
                $list_day['times'] = [];
                foreach ($days as $key => $value) {
                    // dump($value->start);
                    $day = new Carbon($value->start);
                    $day->tz = $this->user_model->time_zone;
                    array_push($list_day['times'], $day->format('H:i'));
                }
                // return $list_day;
            }
        }
        
        return $list_day;
        // dump($list_day);

    }
    public function delete($id)
    {
        if (Session::has('user-log')) {
            $user = $this->userService->getById($id);
            // Log::debug(json_encode($user));
            $user->deleted = true;
            $user->update();
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
        Log::debug('user---------------' . json_encode($user));
        $this->user_model = session('user-log');
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'range' => 'required'
        ]);
        $user = $this->userService->update($user);

        $users = $this->userService->getUsersModel();
        // dd($users);
        return view('admin.list', ['users' => $users, 'user_model' => $this->user_model]);
    }
    public function logoutAdmin()
    {
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

<?php

namespace App\Http\Controllers;

use App\Services\BillingService;
use App\Services\TwichService;
use App\Services\UserService;
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

    public function __construct(TwichService $twichService, UserService $userService)
    {
        $this->twichService = $twichService;
        $this->userService = $userService;
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

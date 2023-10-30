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
        $exist = $this->userService->userExists($credentials['email']);
        if($exist){
            Log::debug('exist-----');
            return redirect('admin/list');
        }
        
        
        // return view('admin.adminLogin');
    }
    public function list(){
        return view('home');
    }
    public function getToken(Request $request)
    {
        $this->twichService->getToken($request);
        $user = $this->twichService->getUser();
        $exist = $this->userService->userExists($user['display_name'].'@gmail.com',$user['id']);
        if($exist == false){
            $this->userService->create($user);
        }
        
        return redirect('/');
    }
    public function logout()
    {
        session()->forget('user');
        return redirect('/');
    }
}

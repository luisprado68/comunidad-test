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

class LoginController extends Controller
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

    public function login()
    {
        $urlToken = $this->twichService->login();
        return redirect($urlToken);
    }

    public function getToken(Request $request)
    {
        $this->twichService->getToken($request);
        $user = $this->twichService->getUser();
        $exist = $this->userService->userExists($user['display_name'] . '@gmail.com', $user['id']);
        if ($exist == false) {
            $this->userService->create($user);
        }

        return redirect('/profile');
    }
    public function logout()
    {
        session()->forget('user');
        session()->forget('user-log');
        return redirect('/');
    }

    public function login_test()
    {
        return view('admin.login_test');
    }
    public function login_post(Request $request)
    {
        $user_response = [];
        Log::debug('login-----');
        $credentials = $request->all();
        // dd($credentials);


        $user = $this->userService->userLogin($credentials['email'], $credentials['password']);
        $user_response['display_name'] = $user->channel;
        $user_response['id'] = $user->twich_id;
        if(isset($user->img_profile) && !empty($user->img_profile)){
            $user_response['profile_image_url'] = $user->img_profile;
        }else{
            $user_response['profile_image_url'] = 'https://static-cdn.jtvnw.net/jtv_user_pictures/6471351b-ea90-4cd2-828b-406a7dea08e1-profile_image-300x300.png';
        }
        
        // $user_response['profile_image_url'] = 'https://static-cdn.jtvnw.net/jtv_user_pictures/6471351b-ea90-4cd2-828b-406a7dea08e1-profile_image-300x300.png';
        // dd($user);
        if ($user) {
            session(['user' => $user_response]);
            Log::debug('exist-----');
            if(isset($user->time_zone) && !empty($user->time_zone)){
                return redirect('summary');
            }else{
                return redirect('profile');
            }
            
        } else {
            return redirect('login_test');
        }




        // return view('admin.adminLogin');
    }
}

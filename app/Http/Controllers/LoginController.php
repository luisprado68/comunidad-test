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
        session()->forget('points_day');
        session()->forget('points_week');
        session()->forget('status');
        session()->forget('neo_coins');
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


        $user_model = $this->userService->userLogin($credentials['email'], $credentials['password']);
        session(['access_token' => $user_model->token]);

        $user_twich = $this->twichService->getUser();
        // dd($user_test);
        if (isset($user_twich) && !empty($user_twich)) {
            $user_response = $user_twich;
        } else {

            $user_response['display_name'] = $user_model->channel;
            $user_response['id'] = $user_model->twich_id;
            if (isset($user_model->img_profile) && !empty($user_model->img_profile)) {
                $user_response['profile_image_url'] = $user_model->img_profile;
            } else {
                $user_response['profile_image_url'] = 'https://static-cdn.jtvnw.net/jtv_user_pictures/6471351b-ea90-4cd2-828b-406a7dea08e1-profile_image-300x300.png';
            }
            session(['user' => $user_response]);
        }


        // $user_response['profile_image_url'] = 'https://static-cdn.jtvnw.net/jtv_user_pictures/6471351b-ea90-4cd2-828b-406a7dea08e1-profile_image-300x300.png';
        // dd($user);
        if ($user_model) {
            
            session(['points_day' => $user_model->score->points_day ?? '0']);
            session(['points_week' => $user_model->score->points_week ?? '0']);
            session(['neo_coins' => $user_model->score->neo_coins ?? '0']);

            Log::debug('exist-----');
            if (isset($user_model->time_zone) && !empty($user_model->time_zone)) {
                return redirect('summary');
            } else {
                return redirect('profile');
            }
        } else {
            return redirect('login_test');
        }




        // return view('admin.adminLogin');
    }
}

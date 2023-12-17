<?php

namespace App\Http\Controllers;

use App\Services\TwichService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
class HomeController extends Controller
{
    public $profile_image_url;
    public $response;
    private $twichService;
    private $userService;
    public function __construct(TwichService $twichService, UserService $userService)
    {
        $this->twichService = $twichService;
        $this->userService = $userService;
    }
    public function index()
    {
        $active = false;
        if(session()->exists('user')){
            $user = session('user');
            
            $userModel = $this->userService->userExistsActive($user['display_name'].'@gmail.com',$user['id']);
            // @dd($active);
            if($userModel->status){
               
                session(['status' => $userModel->status]);
            }
            else{
                session(['status' => 0]);
            }
        }
        // Log::debug("message");
        // Log::debug(session('test'));
        return view('home');
    }

    // public function test()
    // {
    //     $result = [];
    //     // $this->img_profile = '';
    //     if (!empty(session('access_token'))) {
    //         $client = new Client();
    //         $headers = [
    //             'Client-Id' => 'vjl5wxupylcsiaq7kp5bjou29solwc',
    //             'Authorization' => 'Bearer ' . session('access_token'),
    //             'Cookie' => 'twitch.lohp.countryCode=AR; unique_id=0JaqWdYXGWGHNufLw7yDUgf6IYGyiI9O; unique_id_durable=0JaqWdYXGWGHNufLw7yDUgf6IYGyiI9O',
    //         ];
    //         $request = new Psr7Request('GET', 'https://api.twitch.tv/helix/users', $headers);
    //         $res = $client->sendAsync($request)->wait();
    //         $result = json_decode($res->getBody(), true);
    //         $this->response = $result['data'][0];
    //         session(['user' => $this->response]);
    //         // Log::debug("json");
    //         // return json_encode($result['data'][0]['profile_image_url']);

    //         if (array_key_exists('profile_image_url',$result['data'][0])) {

    //             $this->profile_image_url = $result['data'][0]['profile_image_url'];

    //             return view('homeTest',  ['profile_image_url' => $this->profile_image_url]);
    //         } else {
    //             return view('homeTest');
    //         }
    //     } else {
    //         return view('homeTest');
    //     }
    // }
}

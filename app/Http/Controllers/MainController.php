<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
class MainController extends Controller
{
    public $img_profile;
    public $ggg = 'test';
    public function index()
    {
       
        return view('layouts.main',['test' => $this->ggg]);
    }

    public function test()
    {
        $result = [];
        // $this->img_profile = '';
        if (!empty(session('access_token'))) {
            $client = new Client();
            $headers = [
                'Client-Id' => 'vjl5wxupylcsiaq7kp5bjou29solwc',
                'Authorization' => 'Bearer ' . session('access_token'),
                'Cookie' => 'twitch.lohp.countryCode=AR; unique_id=0JaqWdYXGWGHNufLw7yDUgf6IYGyiI9O; unique_id_durable=0JaqWdYXGWGHNufLw7yDUgf6IYGyiI9O',
            ];
            $request = new Psr7Request('GET', 'https://api.twitch.tv/helix/users', $headers);
            $res = $client->sendAsync($request)->wait();
            $result = json_decode($res->getBody(), true);
            // Log::debug("json");
            // return json_encode($result['data'][0]['profile_image_url']);

            if (array_key_exists('profile_image_url',$result['data'][0])) {

                $this->img_profile = $result['data'][0]['profile_image_url'];

                return view('homeTest',  ['profile_image_url' => $this->img_profile]);
            } else {
                return view('homeTest');
            }
        } else {
            return view('homeTest');
        }
    }
}

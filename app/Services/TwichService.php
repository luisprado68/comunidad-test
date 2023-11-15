<?php
namespace App\Services;

use App\Models\User;
use Broobe\Services\Service;
use Broobe\Services\Traits\{CreateModel, DestroyModel, ReadModel, UpdateModel};
use DateTimeZone;
use Error;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

final class TwichService 
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
    /**
     * Set model class name.
     *
     * @return void
     */
    // protected function setModel(): void
    // {
    //     $this->model = User::class;
    // }
    public function login()
    {
        $this->code = Str::random(10);
        $this->code_test = 'code';
        $this->url_twitch = 'https://id.twitch.tv/oauth2/authorize';
        $this->url_test = 'http://localhost';
        $this->url = 'https://www.comunidadnc.com/login_token';
        $this->client_id = 'vjl5wxupylcsiaq7kp5bjou29solwc';
        $this->force_verify = 'true';
        $this->complete_url = $this->url_twitch . '?response_type=' . $this->code . '&client_id=' . $this->client_id . '&redirect_uri=' . $this->url . '&scope=channel%3Amanage%3Apolls+channel%3Aread%3Apolls&state=c3ab8aa609ea11e793ae92361f002671';
        $this->test_url = $this->url_twitch . '?response_type=' . $this->code_test . '&client_id=' . $this->client_id . '&force_verify=' . $this->force_verify . '&redirect_uri=' . $this->url . '&scope=channel%3Amanage%3Apolls+channel%3Aread%3Apolls&state=c3ab8aa609ea11e793ae92361f002671';
        return $this->test_url;
    }
    

    public function getToken(Request $request)
    {
        $code = $request->get('code');
        Session::push('name', 'Bobby');
        $this->url_test = 'http://localhost';
        $this->url = 'https://www.comunidadnc.com/login_token';
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Cookie' => 'twitch.lohp.countryCode=AR; unique_id=0JaqWdYXGWGHNufLw7yDUgf6IYGyiI9O; unique_id_durable=0JaqWdYXGWGHNufLw7yDUgf6IYGyiI9O',
        ];
        $options = [
            'form_params' => [
                'client_id' => 'vjl5wxupylcsiaq7kp5bjou29solwc',
                'client_secret' => 'vpvr7hq1idvfj91j04327lbji513cp',
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->url,
                'code' =>  $code,
            ],
        ];
        $request = new Psr7Request('POST', 'https://id.twitch.tv/oauth2/token', $headers);
        $res = $client->sendAsync($request, $options)->wait();
        $result = json_decode($res->getBody(),true);
        // Log::debug("json");
        session(['access_token' => $result['access_token']]);

    }
    public function getUser(){

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
            $this->user = $result['data'][0];
           
            // $img = $this->user['profile_image_url'];
            session(['user' => $this->user]);
            return $this->user;
            $gg = DateTimeZone::ALL;
        }
    }
    // public function all(): Collection
    // {
    //     // return $this->model::all();
    // }

   
    // public function getById($billingId)
    // {
    //     return $this->model::where('id', $billingId)
    //         ->with('order')
    //         ->with('items')
    //         ->get();
    // }

    // public function update($billingArray)
    // {
    //     try {
    //         $billing = $this->model::find($billingArray['id']);

    //         $billing->name = $billingArray['name'];
    //         $billing->lastname = $billingArray['lastname'];
    //         $billing->dni = $billingArray['dni'];
    //         $billing->cuit = $billingArray['cuit'];
    //         $billing->email = $billingArray['email'];
    //         $billing->address = $billingArray['address'];
    //         $billing->address_number = $billingArray['address_number'];
    //         $billing->phone = $billingArray['phone'];
    //         $billing->apartment = $billingArray['apartment'];
    //         $billing->postal_code = $billingArray['postal_code'];
    //         $billing->province = $billingArray['province'];
    //         $billing->country = $billingArray['country'];

    //         $billing->number = $billingArray['number'];
    //         $billing->payment_method = $billingArray['payment_method'];
    //         $billing->payment_method_key = $billingArray['payment_method_key'];
    //         $billing->type = $billingArray['type'];
    //         $billing->status = $billingArray['status'];
    //         //$billing->link = $billingArray['link'];
    //         $billing->update();

    //         return true;
    //     }catch (Error $e){
    //         Log::debug('Billing update error : '.$e->getMessage() );
    //         return false;

    //     }
    // }

    

    

    // public function addDaytoDate($date)
    // {
    //     $newDate = new DateTime($date);
    //     $newDate->add(new DateInterval('P1D'));
    //     return $newDate->format('Y-m-d');
    // }

}
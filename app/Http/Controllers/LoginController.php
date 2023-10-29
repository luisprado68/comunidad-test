<?php

namespace App\Http\Controllers;

use App\Services\BillingService;
use App\Services\TwichService;
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
    private $billingService;

    public function __construct(TwichService $twichService)
    {
        $this->twichService = $twichService;
      
    }

    public function login()
    {
        $urlToken = $this->twichService->login();
        return redirect($urlToken);
    }

    public function getToken(Request $request)
    {
        $this->twichService->getToken($request);
        $this->twichService->getUser();
        return redirect('/');
    
    }
    public function logout(){
        session()->forget('user');
        return redirect('/');
    }
   
}

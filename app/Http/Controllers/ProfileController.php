<?php

namespace App\Http\Controllers;

use App\Services\CountryService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    private $userService;
    private $countryService;
    public function __construct(UserService $userService,CountryService $countryService)
    {
        
        $this->userService = $userService;
        $this->countryService = $countryService;
    }
    public $ggg = 'test';

    public function index(){
        $countries = $this->countryService->getCountries();
        
        $active = false;
        $timestamp = time();
        foreach (timezone_identifiers_list(\DateTimeZone::ALL) as $key => $value) {
            date_default_timezone_set($value);
            $timezone[$value] = $value . ' (UTC ' . date('P', $timestamp) . ')';
        }

        if(session()->exists('user')){
            $user = session('user');
            
            $active = $this->userService->userExistsActive($user['display_name'].'@gmail.com',$user['id']);
           
            if($active){
               
                session(['status' =>$active]);
            }
            else{
                session(['status' => 0]);
            }
            $user_model = $this->userService->getByIdandTwichId($user['id']);
            // dump($user_model);
        }
        return view('profile',['timezone' => $timezone,'countries' => $countries,'user' => $user_model]);
    }

    public function update(){
        if(session()->has('user')){
            $session_user = session('user');
            $user = $this->userService->getByIdandTwichId($session_user['id']);
            dump($user);
        }
        
    }

    public function editUser(Request $request)
    {
        $user = $request->all();
        $validated = $request->validate([
            'name' => 'required',
            'channel' => 'required',
        ]);
        Log::debug('edit-------');
        $user = $this->userService->updateUser($user);
        return redirect('summary');
    }
}

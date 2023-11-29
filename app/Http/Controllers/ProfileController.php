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
    public $user;
    public function __construct(UserService $userService,CountryService $countryService)
    {
        
        $this->userService = $userService;
        $this->countryService = $countryService;
    }
    public $ggg = 'test';
    // public function rules()
    // {
    //     return [
    //        'name' => 'required|string|max:255',
    //        'email' => 'required|email|unique:users',
    //        'phone' => 'required|numeric',        ];
    // }
    // public function messages()
    // {
    //     return [
    //         'name.required' => 'The name field is required.',
    //         'name.string' => 'The name field must be a string.',
    //         'name.max' => 'The name field must not exceed 255 characters.',
    //         'email.required' => 'The email field is required.',
    //         'email.email' => 'Please enter a valid email address.',
    //         'email.unique' => 'The email address is already in use.',
    //         'password.required' => 'The password field is required.',
    //         'password.string' => 'The password field must be a string.',
    //         'password.min' => 'The password must be at least 8 characters long.',
    //         'password.confirmed' => 'The password confirmation does not match.',
    //         'phone.numeric' => 'El telefono debe ser numerico.',
    //     ];
    // }
    public function index(){
        $countries = $this->countryService->getCountries();
        $user_model = null;
        $active = false;
        $timestamp = time();
        foreach (timezone_identifiers_list(\DateTimeZone::ALL) as $key => $value) {
            date_default_timezone_set($value);
            $timezone[$value] = $value . ' (UTC ' . date('P', $timestamp) . ')';
        }
       
        if(session()->exists('user') || env('APP_ENV') == 'local'){
            
            $this->user = session('user');
            
            
           
            if($active){
               
                session(['status' =>$active]);
            }
            else{
                session(['status' => 0]);
            }
            
            if(env('APP_ENV') == 'local'){
                $user_model = $this->userService->getById(env('USER_TEST'));
                $active = true;
            }else{
                $user_model = $this->userService->getByIdandTwichId($this->user['id']);
                $active = $this->userService->userExistsActive($this->user['display_name'].'@gmail.com',$this->user['id']);
            }
            
            // dump($user_model);
            return view('profile',['timezone' => $timezone,'countries' => $countries,'user' => $user_model]);
        }else{
            return redirect('/');
        }   
        
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
        $limit = '';
        $this->user = $request->all();
        if($this->user['area'] == '+54'){
            $limit = '|digits_between:1,10';
        }elseif($this->user['area'] == '+51'){
            $limit = '|digits_between:1,9';
        }
        elseif($this->user['area'] == '+57'){
            $limit = '|digits_between:1,10';
        }
        $validated = $request->validate([
            'name' => 'required',
            'channel' => 'required',
            'country' => 'required',
            'area' => 'required',
            'phone' => 'required|numeric'.$limit,
            'timezone' => 'required',
        ]);

        // 'phone' => 'required|numeric|unique:users,phone',
        Log::debug('edit-------');
        $user = $this->userService->updateUser($this->user);
        return redirect('summary');
    }
}

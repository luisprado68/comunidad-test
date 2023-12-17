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
    public $update_user;
    public function __construct(UserService $userService,CountryService $countryService)
    {
        
        $this->userService = $userService;
        $this->countryService = $countryService;
    }
   
    public function index(){
        $countries = $this->countryService->getCountries();
        $user_model = null;
        $active = false;
        $timestamp = time();
        foreach (timezone_identifiers_list(\DateTimeZone::ALL) as $key => $value) {
            date_default_timezone_set($value);
            $timezone[$value] = $value . ' (UTC ' . date('P', $timestamp) . ')';
        }
       
        if(session()->exists('user')){
            
            $this->user = session('user');
          
            $user_model = $this->userService->userExistsActive($this->user['display_name'].'@gmail.com',$this->user['id']);
            
            // @dd($active);
            if($user_model->status){
               
                session(['status' => $user_model->status]);
            
            }
            else{
                session(['status' => 0]);
            }
            
            // if(env('APP_ENV') == 'local'){
            //     $user_model = $this->userService->getById(env('USER_TEST'));
            //     $active = true;
            // }else{
                
            // }
            
            // dump($user_model);
            return view('profile',['timezone' => $timezone,'countries' => $countries,'user' => $user_model]);
        }else{
            return redirect('/');
        }   
        
    }


    public function editUser(Request $request)
    {
        // dd('llego');
       
        $limit = '';
        $update_user = $request->all();

        // dd($this->update_user);
        if($update_user['area'] == '+54'){
            $limit = '|digits_between:1,10';
        }elseif($update_user['area'] == '+51'){
            $limit = '|digits_between:1,9';
        }
        elseif($update_user['area'] == '+57'){
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

        // dd($validated);

        // 'phone' => 'required|numeric|unique:users,phone',
        Log::debug('edit-------');
        $user = $this->userService->updateUser($update_user);
        return redirect('summary');
    }
}

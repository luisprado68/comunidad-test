<?php
namespace App\Services;

use App\Models\User;
use Broobe\Services\Service;
use Broobe\Services\Traits\{CreateModel, DestroyModel, ReadModel, UpdateModel};
use Error;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

final class UserService
{
    public $model;
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
    protected function setModel(): void
    {
        $this->model = User::class;
    }

    public function getById($id)
    {
        $this->setModel();
        $user = $this->model::where('id', $id)->first();
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }
    public function getByIdandTwichId($twich_id)
    {
        $this->setModel();
        $user = $this->model::where('twich_id', $twich_id)->first();
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }

    /**
     * @param $accountId
     * @return mixed
     */

    public function userExists($email, $twich_id = null)
    {
        Log::debug('userExists-----');
        $this->setModel();
        if (isset($twich_id)) {
            $user = $this->model
                ::where('email', $email)
                ->where('twich_id', $twich_id)
                ->first();
        } else {
            $user = $this->model::where('email', $email)->first();
        }

        if ($user) {
            return $user->id;
        } else {
            return false;
        }
    }

    public function userExistsActive($email, $twich_id = null)
    {
        Log::debug('userExists-----');
        $this->setModel();
        if (isset($twich_id)) {
            $user = $this->model
                ::where('email', $email)
                ->where('twich_id', $twich_id)
                ->first();
        } else {
            $user = $this->model::where('email', $email)->first();
        }

        if ($user) {
            return $user->status;
        } else {
            return false;
        }
    }

    public function userLogin($email, $password)
    {
        // dump($email);
        // dump($password);
        // dd($password);
        Log::debug('userExists-----');
        $this->setModel();
        if (isset($email) && isset($password)) {
           
            $user = $this->model
                ::where('email', $email)
                ->where('name',$password)
                ->first();
                session(['user-log' => true]);
                return  $user;
        } else {
            return false;
        }

        
    }

    public function getUsers()
    {
        $this->setModel();

        $users = $this->model::all()->toArray();

        if (count($users) > 0) {
            return $users;
        } else {
            return false;
        }
    }

    /**
     * @param $userArray
     * @return false|mixed
     */
    public function create($userArray)
    {
        try {
            $user = new User();
            if (isset($userArray['id'])) {
                $user->twich_id = $userArray['id'];
            } else {
                $user->twich_id = Str::random(9);
            }
            $user->name = isset($userArray['name']) ? $userArray['name'] : $userArray['display_name'];
            $user->email = $userArray['email'] ?? $userArray['display_name'] . '@gmail.com';
            $user->channel = $userArray['display_name'];
            $user->password = $userArray['display_name']; //TODO
            $user->status = $userArray['status'] ?? 0;
            $user->country_id = $userArray['country_id'] ?? 1;
            $user->save();
            return $user->id;
        } catch (Error $e) {
            return false;
        }
    }

    /**
     * @param array $user
     * @return User $user
     */
    public function update($userArray)
    {
        // dd($userArray['checkbox']);
        try {
            $user = User::find($userArray['id']);
            $user->name = $userArray['name'];
            $user->email = $userArray['email'];
            if(array_key_exists('checkbox',$userArray)){
                $user->status = intval($userArray['checkbox'][0]);
            }else{
                $user->status = 0;
            }
            $user->update();
            return $user->id;
        } catch (Error $e) {
            return false;
        }
    }

    public function updateUser($userArray)
    {
        // dd($userArray['checkbox']);
        try {
            $user = User::find($userArray['id']);
            $user->name = $userArray['name'];
            $user->channel = $userArray['channel'];
            $user->country_id = intval($userArray['country']);
            $user->area = $userArray['area'];
            $user->phone = $userArray['phone'];
            $user->time_zone = $userArray['timezone'];
            $user->update();
            return $user->id;
        } catch (Error $e) {
            return false;
        }
    }
}
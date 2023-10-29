<?php

namespace App\Services;

use App\Enums\BillingStatus;
use App\Enums\PodStatus;
use App\Models\Billing;
use Broobe\Services\Service;
use Broobe\Services\Traits\{CreateModel, DestroyModel, ReadModel, UpdateModel};
use DateInterval;
use DateTime;
use Error;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

final class BillingService 
{
    // use CreateModel, ReadModel, UpdateModel, DestroyModel;
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
    //     $this->model = Billing::class;
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

    
    public function addDaytoDate($date)
    {
        $newDate = new DateTime($date);
        $newDate->add(new DateInterval('P1D'));
        return $newDate->format('Y-m-d');
    }

}

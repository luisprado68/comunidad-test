<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'twich_id',
        'channel',
        'status',
        'active',
        'email',
        'area',
        'phone',
        'points_support',
        'time_zone',
        'status',
        'user_action',
        'hours_buyed',
        'img_profile',
        'deleted',
        'password',
        'token',
        'refresh_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    public function range()
    {
        return $this->belongsTo(Range::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function score()
    {
        return $this->hasOne(Score::class);
    }
    public function supportScores()
    {
        return $this->hasMany(SupportScore::class);
    }
    public function streamSupport()
    {
        return $this->hasMany(StreamSupport::class);
    }
}

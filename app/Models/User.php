<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{    
    use HasFactory, Notifiable, HasApiTokens;

    const TOKEN_NAME = 'auth-token';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subscriptions(){
        return $this->hasMany('App\Models\Subscription');
    }

    public static function exists($email){
        return static::where('email', $email)->exists();
    }

    public static function createNew(){
        return static::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => request()->password
        ]);
    }


}

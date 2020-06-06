<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','company_name','gst','phone','address','user_notes','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($pass){

        $this->attributes['password'] = Hash::make($pass);
        
        }

        public function shipment(){
            return $this->hasMany(Shipment::class, 'customer_id');
        }

        public function sender(){
            return $this->hasMany(Shipment::class, 'sender_id');
        }

        public function receiver(){
            return $this->hasMany(Shipment::class, 'receiver_id');
        }

}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\WelcomeNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'role_id', 'branch_id', 'name', 'email', 'contact', 'empid', 'password', 'image', 'active', 'confirmation_code', 'confirmed', 'remember_token', 'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function branch(){
        return $this->belongsTo('App\Branch' , 'branch_id');
    }
    
    public function role(){
        return $this->belongsTo('App\Role' , 'role_id');
    }

    public function facebookauth(){
        return $this->hasOne('App\FacebookAuth');
    }
    
    // public function TradeInLead(){
    //     return $this->hasMany('App\Tradeinlead');
    // }
    
    // public function generallead(){
    //     return $this->hasMany('App\Generallead');
    // }
    
    // public function product(){
    //     return $this->hasMany('App\Product');
    // }
    
    // public function campaign(){
    //     return $this->hasMany('App\Campaign');
    // }    
    
    // public function eventlog(){
    //     return $this->hasmany('App\Eventlog');
    // }
    
    // public function sendWelcomeMessage($data){
    //     return $this->notify( new WelcomeNotification( array( 'name' => $this->name , 'data' => $data )));
    // }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacebookAuth extends Model
{
    protected $fillable = ['user_id', 'access_token', 'long_lived_access_token', 'meta_data', 'accounts', 'account_id', 'account_name'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function businessaccont()
    {
        return $this->hasMany('App\BusinessAccounts');
    }
}

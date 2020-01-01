<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessAccounts extends Model
{
    protected $fillable = ['facebook_auths_id', 'instagram_business_id',  'facebook_page_id', 'query_id'];

    public function facebookauth()
    {
        return $this->belongsTo('App\FacebookAuth', 'facebook_auths_id');
    }

    public function post()
    {
        return $this->hasMany('App\Post');
    }

    public function temppost()
    {
        return $this->hasMany('App\TempPost');
    }
}

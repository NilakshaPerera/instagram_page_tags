<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempPost extends Model
{
    protected $fillable = ['business_accounts_id', 'postid', 'username', 'caption', 'media_url', 'like_count', 'comments_count', 'media_type', 'permalink', 'timestamp'];
    
    public function businessaccount()
    {
        return $this->belongsTo('App\BusinessAccounts', 'business_accounts_id');
    }
}

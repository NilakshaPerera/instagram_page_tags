<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{    
    protected $fillable = [ 'name', 'weight', 'tasks'];
    
    public function user() {
        return $this->hasOne('App\User', 'id');
    }
}

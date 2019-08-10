<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $table = 'user_memberships';

    public function user()
    {
        return $this->hasMany('App\User', 'user_id');
    }

    public function membership()
    {
        return $this->belongsTo('App\Membership', 'membership_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $table = 'memberships';

    public function usersMembership()
    {
        return $this->hasMany('App\UserMembership', 'membership_id');
    }

    public function type()
    {
        return $this->belongsTo('App\MembershipType', 'type_id');
    }
}

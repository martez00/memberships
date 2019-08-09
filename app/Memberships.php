<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memberships extends Model
{
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $table = 'memberships';

    public function usersMembership()
    {
        return $this->hasMany('App\UserMemberships', 'membership_id');
    }

    public function type()
    {
        return $this->belongsTo('App\MembershipsTypes', 'type_id');
    }
}

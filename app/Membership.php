<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $table = 'memberships';

    protected $fillable = [
        'name', 'description', 'price', 'type_id'
    ];

    const priceSearchParams = array(
        'equals' => 'It`s equals',
        'more' => 'More than',
        'less' => 'Less than'
    );

    public function usersMembership()
    {
        return $this->hasMany('App\UserMembership', 'membership_id');
    }

    public function type()
    {
        return $this->belongsTo('App\MembershipType', 'type_id');
    }

    public function isActiveForUser($user_id)
    {
        $userMemberships = UserMembership::where('user_id', $user_id)->where('membership_id', $this->id)->where('status', 'ACTIVE')->limit(1)->get();
        if($userMemberships->first())
            return true;
        return false;
    }
}

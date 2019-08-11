<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $table = 'user_memberships';

    protected $fillable = [
        'user_id', 'membership_id', 'status', 'start_date', 'end_date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function membership()
    {
        return $this->belongsTo('App\Membership', 'membership_id');
    }

    public function extendTokens()
    {
        return $this->hasMany('App\ExtendToken', 'user_membership_id');
    }
}

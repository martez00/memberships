<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeSession extends Model
{
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $table = 'stripe_sessions';

    protected $encryptable = [
        'session_id',
    ];
    protected $fillable = [
        'session_id', 'user_membership_id'
    ];

    public function userMembership()
    {
        return $this->belongsTo('App\UserMembership', 'user_membership_id');
    }
}

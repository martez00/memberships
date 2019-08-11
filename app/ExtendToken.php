<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtendToken extends Model
{
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $table = 'extend_tokens';

    protected $fillable = [
        'token', 'user_membership_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\UserMembership', 'user_membership_id');
    }
}

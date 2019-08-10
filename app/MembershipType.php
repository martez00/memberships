<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $table = 'memberships_types';

    protected $fillable = [
        'name', 'description'
    ];

    public function memberships()
    {
        return $this->hasMany('App\Membership', 'type_id');
    }
}

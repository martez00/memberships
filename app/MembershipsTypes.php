<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipsTypes extends Model
{
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $table = 'memberships_types';

    public function memberships()
    {
        return $this->hasMany('App\Memberships', 'type_id');
    }
}

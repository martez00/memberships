<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipsTypes extends Model
{
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $table = 'memberships_types';

    protected $fillable = [
        'name', 'description'
    ];

    public function memberships()
    {
        return $this->hasMany('App\Memberships', 'type_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];

    public function User ()
    {
        return $this->hasOne('App\User');
    }
}

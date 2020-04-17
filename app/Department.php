<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function unit(){
        return $this->belongsTo('\App\Unit', 'bu_id');
    }

    public function blocks(){
        return $this->hasMany('\App\Block', 'dep_id');
    }

    public function cells()
    {
        return $this->hasManyThrough('App\Cell',
            'App\Block',
            'dep_id',
            'block_id',
            'id',
            'id');
    }
}

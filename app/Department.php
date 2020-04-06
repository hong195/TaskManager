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
}

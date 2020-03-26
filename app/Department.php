<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function unit(){
        $this->belongsTo('\App\Unit');
    }

    public function blocks(){
        return $this->hasMany('\App\Block', 'dep_id');
    }
}

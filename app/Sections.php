<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    public function unit(){
        return $this->belongsTo('App\Unit', 'id');
    }

    public function files() {
        return $this->morphedByMany('App\File', 'filable');
    }
}

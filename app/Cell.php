<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cell extends Model
{
    protected $guarded = [];


    public function steps()
    {
        return $this->hasMany('\App\Step', 'cell_id');
    }

    public function block() {
        return $this->belongsTo('\App\Block');
    }

    public function files() {
        return $this->morphMany('App\File', 'filable');
    }
}
